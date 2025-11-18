<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PerformanceService
{
    /**
     * Get system performance metrics
     */
    public function getSystemMetrics(): array
    {
        return [
            'database' => $this->getDatabaseMetrics(),
            'storage' => $this->getStorageMetrics(),
            'memory' => $this->getMemoryMetrics(),
            'cache' => $this->getCacheMetrics(),
            'queries' => $this->getQueryMetrics(),
        ];
    }

    /**
     * Get database performance metrics
     */
    private function getDatabaseMetrics(): array
    {
        try {
            $startTime = microtime(true);
            
            // Test database connection
            DB::connection()->getPdo();
            
            $connectionTime = (microtime(true) - $startTime) * 1000; // Convert to milliseconds
            
            // Get database size
            $databaseSize = $this->getDatabaseSize();
            
            // Get table statistics
            $tableStats = $this->getTableStatistics();
            
            return [
                'status' => 'connected',
                'connection_time_ms' => round($connectionTime, 2),
                'database_size_mb' => $databaseSize,
                'tables' => $tableStats,
                'last_checked' => now()->toISOString(),
            ];
        } catch (\Exception $e) {
            Log::error('Database performance check failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return [
                'status' => 'error',
                'error' => $e->getMessage(),
                'last_checked' => now()->toISOString(),
            ];
        }
    }

    /**
     * Get storage metrics
     */
    private function getStorageMetrics(): array
    {
        try {
            $storagePath = storage_path('app/public');
            $totalSpace = disk_total_space($storagePath);
            $freeSpace = disk_free_space($storagePath);
            $usedSpace = $totalSpace - $freeSpace;
            
            // Get photos storage usage
            $photosSize = $this->getPhotosStorageSize();
            
            return [
                'total_space_gb' => round($totalSpace / (1024 * 1024 * 1024), 2),
                'free_space_gb' => round($freeSpace / (1024 * 1024 * 1024), 2),
                'used_space_gb' => round($usedSpace / (1024 * 1024 * 1024), 2),
                'usage_percentage' => round(($usedSpace / $totalSpace) * 100, 2),
                'photos_size_mb' => round($photosSize / (1024 * 1024), 2),
                'last_checked' => now()->toISOString(),
            ];
        } catch (\Exception $e) {
            Log::error('Storage metrics check failed', [
                'error' => $e->getMessage(),
            ]);
            
            return [
                'status' => 'error',
                'error' => $e->getMessage(),
                'last_checked' => now()->toISOString(),
            ];
        }
    }

    /**
     * Get memory usage metrics
     */
    private function getMemoryMetrics(): array
    {
        $memoryUsage = memory_get_usage(true);
        $peakMemoryUsage = memory_get_peak_usage(true);
        $memoryLimit = ini_get('memory_limit');
        
        // Convert memory limit to bytes
        $memoryLimitBytes = $this->convertToBytes($memoryLimit);
        
        return [
            'current_usage_mb' => round($memoryUsage / (1024 * 1024), 2),
            'peak_usage_mb' => round($peakMemoryUsage / (1024 * 1024), 2),
            'limit_mb' => round($memoryLimitBytes / (1024 * 1024), 2),
            'usage_percentage' => round(($memoryUsage / $memoryLimitBytes) * 100, 2),
            'last_checked' => now()->toISOString(),
        ];
    }

    /**
     * Get cache metrics
     */
    private function getCacheMetrics(): array
    {
        try {
            $cacheDriver = config('cache.default');
            $cacheSize = $this->getCacheSize();
            
            return [
                'driver' => $cacheDriver,
                'size_mb' => $cacheSize,
                'status' => 'active',
                'last_checked' => now()->toISOString(),
            ];
        } catch (\Exception $e) {
            return [
                'driver' => config('cache.default'),
                'status' => 'error',
                'error' => $e->getMessage(),
                'last_checked' => now()->toISOString(),
            ];
        }
    }

    /**
     * Get query performance metrics
     */
    private function getQueryMetrics(): array
    {
        try {
            // Enable query logging
            DB::enableQueryLog();
            
            // Run some test queries
            $startTime = microtime(true);
            
            \App\Models\Photo::count();
            \App\Models\Information::count();
            \App\Models\User::count();
            
            $queryTime = (microtime(true) - $startTime) * 1000;
            
            $queries = DB::getQueryLog();
            DB::disableQueryLog();
            
            return [
                'total_queries' => count($queries),
                'total_time_ms' => round($queryTime, 2),
                'average_time_ms' => count($queries) > 0 ? round($queryTime / count($queries), 2) : 0,
                'slowest_query_ms' => $this->getSlowestQueryTime($queries),
                'last_checked' => now()->toISOString(),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'error' => $e->getMessage(),
                'last_checked' => now()->toISOString(),
            ];
        }
    }

    /**
     * Get database size in MB
     */
    private function getDatabaseSize(): float
    {
        try {
            $databaseName = config('database.connections.mysql.database');
            $result = DB::select("
                SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb
                FROM information_schema.tables
                WHERE table_schema = ?
            ", [$databaseName]);
            
            return $result[0]->size_mb ?? 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get table statistics
     */
    private function getTableStatistics(): array
    {
        try {
            $tables = ['photos', 'information', 'users'];
            $stats = [];
            
            foreach ($tables as $table) {
                $count = DB::table($table)->count();
                $stats[$table] = [
                    'rows' => $count,
                    'last_updated' => now()->toISOString(),
                ];
            }
            
            return $stats;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get photos storage size in bytes
     */
    private function getPhotosStorageSize(): int
    {
        try {
            $photosPath = storage_path('app/public/photos');
            if (!is_dir($photosPath)) {
                return 0;
            }
            
            $size = 0;
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($photosPath)
            );
            
            foreach ($iterator as $file) {
                if ($file->isFile()) {
                    $size += $file->getSize();
                }
            }
            
            return $size;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get cache size in MB
     */
    private function getCacheSize(): float
    {
        try {
            $cachePath = storage_path('framework/cache');
            if (!is_dir($cachePath)) {
                return 0;
            }
            
            $size = 0;
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($cachePath)
            );
            
            foreach ($iterator as $file) {
                if ($file->isFile()) {
                    $size += $file->getSize();
                }
            }
            
            return round($size / (1024 * 1024), 2);
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get slowest query time
     */
    private function getSlowestQueryTime(array $queries): float
    {
        if (empty($queries)) {
            return 0;
        }
        
        $maxTime = 0;
        foreach ($queries as $query) {
            if ($query['time'] > $maxTime) {
                $maxTime = $query['time'];
            }
        }
        
        return round($maxTime, 2);
    }

    /**
     * Convert memory limit string to bytes
     */
    private function convertToBytes(string $memoryLimit): int
    {
        $memoryLimit = trim($memoryLimit);
        $last = strtolower($memoryLimit[strlen($memoryLimit) - 1]);
        $value = (int) $memoryLimit;
        
        switch ($last) {
            case 'g':
                $value *= 1024;
            case 'm':
                $value *= 1024;
            case 'k':
                $value *= 1024;
        }
        
        return $value;
    }

    /**
     * Get performance recommendations
     */
    public function getPerformanceRecommendations(): array
    {
        $metrics = $this->getSystemMetrics();
        $recommendations = [];
        
        // Database recommendations
        if (isset($metrics['database']['connection_time_ms']) && $metrics['database']['connection_time_ms'] > 100) {
            $recommendations[] = [
                'type' => 'database',
                'priority' => 'high',
                'message' => 'Database connection is slow. Consider optimizing database configuration.',
            ];
        }
        
        // Memory recommendations
        if (isset($metrics['memory']['usage_percentage']) && $metrics['memory']['usage_percentage'] > 80) {
            $recommendations[] = [
                'type' => 'memory',
                'priority' => 'high',
                'message' => 'Memory usage is high. Consider increasing memory limit or optimizing code.',
            ];
        }
        
        // Storage recommendations
        if (isset($metrics['storage']['usage_percentage']) && $metrics['storage']['usage_percentage'] > 90) {
            $recommendations[] = [
                'type' => 'storage',
                'priority' => 'critical',
                'message' => 'Storage is almost full. Consider cleaning up old files or increasing storage.',
            ];
        }
        
        // Query recommendations
        if (isset($metrics['queries']['average_time_ms']) && $metrics['queries']['average_time_ms'] > 50) {
            $recommendations[] = [
                'type' => 'queries',
                'priority' => 'medium',
                'message' => 'Database queries are slow. Consider adding indexes or optimizing queries.',
            ];
        }
        
        return $recommendations;
    }

    /**
     * Clear performance cache
     */
    public function clearPerformanceCache(): bool
    {
        try {
            Cache::flush();
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to clear performance cache', [
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
