<?php

namespace App\Tools;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class DatabaseOptimizer
{
    /**
     * Optimize database tables
     */
    public function optimizeTables(): array
    {
        $results = [];
        $tables = $this->getTables();
        
        foreach ($tables as $table) {
            try {
                $startTime = microtime(true);
                
                // Run OPTIMIZE TABLE
                DB::statement("OPTIMIZE TABLE `{$table}`");
                
                $endTime = microtime(true);
                $duration = round(($endTime - $startTime) * 1000, 2);
                
                $results[$table] = [
                    'status' => 'optimized',
                    'duration_ms' => $duration
                ];
                
                Log::info("Table optimized: {$table}", [
                    'duration_ms' => $duration
                ]);
            } catch (\Exception $e) {
                $results[$table] = [
                    'status' => 'error',
                    'error' => $e->getMessage()
                ];
                
                Log::error("Failed to optimize table: {$table}", [
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        return $results;
    }

    /**
     * Analyze database tables
     */
    public function analyzeTables(): array
    {
        $results = [];
        $tables = $this->getTables();
        
        foreach ($tables as $table) {
            try {
                $startTime = microtime(true);
                
                // Run ANALYZE TABLE
                DB::statement("ANALYZE TABLE `{$table}`");
                
                $endTime = microtime(true);
                $duration = round(($endTime - $startTime) * 1000, 2);
                
                $results[$table] = [
                    'status' => 'analyzed',
                    'duration_ms' => $duration
                ];
            } catch (\Exception $e) {
                $results[$table] = [
                    'status' => 'error',
                    'error' => $e->getMessage()
                ];
            }
        }
        
        return $results;
    }

    /**
     * Get table statistics
     */
    public function getTableStats(): array
    {
        $tables = $this->getTables();
        $stats = [];
        
        foreach ($tables as $table) {
            try {
                $tableStats = DB::select("
                    SELECT 
                        table_name,
                        table_rows,
                        ROUND(((data_length + index_length) / 1024 / 1024), 2) AS size_mb,
                        ROUND((data_length / 1024 / 1024), 2) AS data_mb,
                        ROUND((index_length / 1024 / 1024), 2) AS index_mb,
                        ROUND((data_free / 1024 / 1024), 2) AS free_mb
                    FROM information_schema.tables 
                    WHERE table_schema = ? AND table_name = ?
                ", [config('database.connections.mysql.database'), $table]);
                
                if (!empty($tableStats)) {
                    $stats[$table] = $tableStats[0];
                }
            } catch (\Exception $e) {
                $stats[$table] = [
                    'error' => $e->getMessage()
                ];
            }
        }
        
        return $stats;
    }

    /**
     * Check for missing indexes
     */
    public function checkMissingIndexes(): array
    {
        $recommendations = [];
        
        // Check photos table
        $photosIndexes = $this->getTableIndexes('photos');
        if (!in_array('idx_category', $photosIndexes)) {
            $recommendations[] = [
                'table' => 'photos',
                'column' => 'category',
                'type' => 'INDEX',
                'reason' => 'Frequently queried for filtering'
            ];
        }
        
        if (!in_array('idx_uploaded_by', $photosIndexes)) {
            $recommendations[] = [
                'table' => 'photos',
                'column' => 'uploaded_by',
                'type' => 'INDEX',
                'reason' => 'Foreign key for user relationships'
            ];
        }
        
        if (!in_array('idx_created_at', $photosIndexes)) {
            $recommendations[] = [
                'table' => 'photos',
                'column' => 'created_at',
                'type' => 'INDEX',
                'reason' => 'Used for ordering and date filtering'
            ];
        }
        
        // Check information table
        $informationIndexes = $this->getTableIndexes('information');
        if (!in_array('idx_type', $informationIndexes)) {
            $recommendations[] = [
                'table' => 'information',
                'column' => 'type',
                'type' => 'INDEX',
                'reason' => 'Frequently queried for filtering by type'
            ];
        }
        
        if (!in_array('idx_priority', $informationIndexes)) {
            $recommendations[] = [
                'table' => 'information',
                'column' => 'priority',
                'type' => 'INDEX',
                'reason' => 'Used for ordering by priority'
            ];
        }
        
        if (!in_array('idx_published', $informationIndexes)) {
            $recommendations[] = [
                'table' => 'information',
                'column' => 'is_published',
                'type' => 'INDEX',
                'reason' => 'Frequently queried for published status'
            ];
        }
        
        if (!in_array('idx_expires_at', $informationIndexes)) {
            $recommendations[] = [
                'table' => 'information',
                'column' => 'expires_at',
                'type' => 'INDEX',
                'reason' => 'Used for filtering expired information'
            ];
        }
        
        // Check users table
        $usersIndexes = $this->getTableIndexes('users');
        if (!in_array('idx_username', $usersIndexes)) {
            $recommendations[] = [
                'table' => 'users',
                'column' => 'username',
                'type' => 'UNIQUE INDEX',
                'reason' => 'Used for login authentication'
            ];
        }
        
        if (!in_array('idx_email', $usersIndexes)) {
            $recommendations[] = [
                'table' => 'users',
                'column' => 'email',
                'type' => 'UNIQUE INDEX',
                'reason' => 'Used for user identification'
            ];
        }
        
        if (!in_array('idx_role', $usersIndexes)) {
            $recommendations[] = [
                'table' => 'users',
                'column' => 'role',
                'type' => 'INDEX',
                'reason' => 'Used for role-based access control'
            ];
        }
        
        return $recommendations;
    }

    /**
     * Get slow queries
     */
    public function getSlowQueries(): array
    {
        try {
            // Enable slow query log
            DB::statement("SET GLOBAL slow_query_log = 'ON'");
            DB::statement("SET GLOBAL long_query_time = 1"); // 1 second
            
            // Get slow queries from performance schema
            $slowQueries = DB::select("
                SELECT 
                    DIGEST_TEXT as query,
                    COUNT_STAR as executions,
                    AVG_TIMER_WAIT/1000000000000 as avg_time_seconds,
                    MAX_TIMER_WAIT/1000000000000 as max_time_seconds,
                    SUM_ROWS_EXAMINED as total_rows_examined,
                    SUM_ROWS_SENT as total_rows_sent
                FROM performance_schema.events_statements_summary_by_digest 
                WHERE AVG_TIMER_WAIT > 1000000000000 
                ORDER BY AVG_TIMER_WAIT DESC 
                LIMIT 10
            ");
            
            return $slowQueries;
        } catch (\Exception $e) {
            Log::error('Failed to get slow queries', [
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * Get database size
     */
    public function getDatabaseSize(): array
    {
        try {
            $result = DB::select("
                SELECT 
                    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb,
                    ROUND(SUM(data_length) / 1024 / 1024, 2) AS data_mb,
                    ROUND(SUM(index_length) / 1024 / 1024, 2) AS index_mb,
                    ROUND(SUM(data_free) / 1024 / 1024, 2) AS free_mb
                FROM information_schema.tables 
                WHERE table_schema = ?
            ", [config('database.connections.mysql.database')]);
            
            return $result[0] ?? [];
        } catch (\Exception $e) {
            Log::error('Failed to get database size', [
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * Get table indexes
     */
    private function getTableIndexes(string $table): array
    {
        try {
            $indexes = DB::select("
                SELECT INDEX_NAME 
                FROM information_schema.STATISTICS 
                WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?
                GROUP BY INDEX_NAME
            ", [config('database.connections.mysql.database'), $table]);
            
            return array_column($indexes, 'INDEX_NAME');
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get all tables
     */
    private function getTables(): array
    {
        try {
            $tables = DB::select("
                SELECT TABLE_NAME 
                FROM information_schema.TABLES 
                WHERE TABLE_SCHEMA = ? AND TABLE_TYPE = 'BASE TABLE'
            ", [config('database.connections.mysql.database')]);
            
            return array_column($tables, 'TABLE_NAME');
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Create recommended indexes
     */
    public function createRecommendedIndexes(): array
    {
        $recommendations = $this->checkMissingIndexes();
        $results = [];
        
        foreach ($recommendations as $recommendation) {
            try {
                $indexName = "idx_{$recommendation['column']}";
                $sql = "ALTER TABLE `{$recommendation['table']}` ADD INDEX `{$indexName}` (`{$recommendation['column']}`)";
                
                DB::statement($sql);
                
                $results[] = [
                    'table' => $recommendation['table'],
                    'index' => $indexName,
                    'column' => $recommendation['column'],
                    'status' => 'created'
                ];
                
                Log::info("Index created: {$indexName} on {$recommendation['table']}.{$recommendation['column']}");
            } catch (\Exception $e) {
                $results[] = [
                    'table' => $recommendation['table'],
                    'index' => $indexName ?? 'unknown',
                    'column' => $recommendation['column'],
                    'status' => 'error',
                    'error' => $e->getMessage()
                ];
            }
        }
        
        return $results;
    }

    /**
     * Get query performance statistics
     */
    public function getQueryStats(): array
    {
        try {
            $stats = DB::select("
                SELECT 
                    COUNT(*) as total_queries,
                    ROUND(AVG(TIMER_WAIT)/1000000000000, 4) as avg_time_seconds,
                    ROUND(MAX(TIMER_WAIT)/1000000000000, 4) as max_time_seconds,
                    SUM(ROWS_EXAMINED) as total_rows_examined,
                    SUM(ROWS_SENT) as total_rows_sent
                FROM performance_schema.events_statements_summary_by_digest
            ");
            
            return $stats[0] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Clean up old data
     */
    public function cleanupOldData(): array
    {
        $results = [];
        
        try {
            // Clean up expired information
            $expiredInfo = \App\Models\Information::where('is_published', true)
                ->where('expires_at', '<=', now())
                ->update(['is_published' => false]);
            
            $results['expired_information'] = [
                'count' => $expiredInfo,
                'action' => 'unpublished'
            ];
            
            // Clean up old logs (if using database logging)
            if (Schema::hasTable('logs')) {
                $oldLogs = DB::table('logs')
                    ->where('created_at', '<', now()->subDays(30))
                    ->delete();
                
                $results['old_logs'] = [
                    'count' => $oldLogs,
                    'action' => 'deleted'
                ];
            }
            
        } catch (\Exception $e) {
            $results['error'] = $e->getMessage();
        }
        
        return $results;
    }
}

