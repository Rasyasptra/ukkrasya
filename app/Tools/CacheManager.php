<?php

namespace App\Tools;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class CacheManager
{
    /**
     * Cache keys constants
     */
    private const CACHE_KEYS = [
        'PHOTOS_COUNT' => 'photos:count',
        'INFORMATION_COUNT' => 'information:count',
        'USERS_COUNT' => 'users:count',
        'RECENT_PHOTOS' => 'photos:recent:',
        'RECENT_INFORMATION' => 'information:recent:',
        'PHOTOS_BY_CATEGORY' => 'photos:category:',
        'INFORMATION_BY_TYPE' => 'information:type:',
        'SYSTEM_METRICS' => 'system:metrics',
        'STORAGE_STATS' => 'storage:stats',
        'CATEGORY_OPTIONS' => 'categories:options'
    ];

    /**
     * Cache TTL in seconds
     */
    private const CACHE_TTL = [
        'SHORT' => 300,    // 5 minutes
        'MEDIUM' => 1800,  // 30 minutes
        'LONG' => 3600,    // 1 hour
        'VERY_LONG' => 86400 // 24 hours
    ];

    /**
     * Get photos count with caching
     */
    public function getPhotosCount(): int
    {
        return Cache::remember(
            self::CACHE_KEYS['PHOTOS_COUNT'],
            self::CACHE_TTL['MEDIUM'],
            fn() => \App\Models\Photo::count()
        );
    }

    /**
     * Get information count with caching
     */
    public function getInformationCount(): int
    {
        return Cache::remember(
            self::CACHE_KEYS['INFORMATION_COUNT'],
            self::CACHE_TTL['MEDIUM'],
            fn() => \App\Models\Information::count()
        );
    }

    /**
     * Get users count with caching
     */
    public function getUsersCount(): int
    {
        return Cache::remember(
            self::CACHE_KEYS['USERS_COUNT'],
            self::CACHE_TTL['LONG'],
            fn() => \App\Models\User::count()
        );
    }

    /**
     * Get recent photos with caching
     */
    public function getRecentPhotos(int $limit = 6)
    {
        $cacheKey = self::CACHE_KEYS['RECENT_PHOTOS'] . $limit;
        
        return Cache::remember(
            $cacheKey,
            self::CACHE_TTL['SHORT'],
            fn() => \App\Models\Photo::with('user')
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get()
        );
    }

    /**
     * Get recent information with caching
     */
    public function getRecentInformation(int $limit = 5)
    {
        $cacheKey = self::CACHE_KEYS['RECENT_INFORMATION'] . $limit;
        
        return Cache::remember(
            $cacheKey,
            self::CACHE_TTL['SHORT'],
            fn() => \App\Models\Information::where('is_published', true)
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                ->orderBy('published_at', 'desc')
                ->limit($limit)
                ->get()
        );
    }

    /**
     * Get photos by category with caching
     */
    public function getPhotosByCategory(string $category, int $page = 1, int $perPage = 12)
    {
        $cacheKey = self::CACHE_KEYS['PHOTOS_BY_CATEGORY'] . $category . ':page:' . $page . ':per_page:' . $perPage;
        
        return Cache::remember(
            $cacheKey,
            self::CACHE_TTL['MEDIUM'],
            fn() => \App\Models\Photo::where('category', $category)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page)
        );
    }

    /**
     * Get information by type with caching
     */
    public function getInformationByType(string $type, int $page = 1, int $perPage = 10)
    {
        $cacheKey = self::CACHE_KEYS['INFORMATION_BY_TYPE'] . $type . ':page:' . $page . ':per_page:' . $perPage;
        
        return Cache::remember(
            $cacheKey,
            self::CACHE_TTL['MEDIUM'],
            fn() => \App\Models\Information::where('type', $type)
                ->where('is_published', true)
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                ->orderBy('priority', 'desc')
                ->orderBy('published_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page)
        );
    }

    /**
     * Get system metrics with caching
     */
    public function getSystemMetrics(): array
    {
        return Cache::remember(
            self::CACHE_KEYS['SYSTEM_METRICS'],
            self::CACHE_TTL['SHORT'],
            fn() => (new \App\Services\PerformanceService())->getSystemMetrics()
        );
    }

    /**
     * Get storage statistics with caching
     */
    public function getStorageStats(): array
    {
        return Cache::remember(
            self::CACHE_KEYS['STORAGE_STATS'],
            self::CACHE_TTL['MEDIUM'],
            fn() => (new \App\Tools\FileManager())->getStorageStats()
        );
    }

    /**
     * Get category options with caching
     */
    public function getCategoryOptions(): array
    {
        return Cache::remember(
            self::CACHE_KEYS['CATEGORY_OPTIONS'],
            self::CACHE_TTL['VERY_LONG'],
            fn() => \App\Helpers\CategoryHelper::getCategories()
        );
    }

    /**
     * Clear photos related cache
     */
    public function clearPhotosCache(): void
    {
        $this->clearCacheByPattern('photos:*');
        $this->clearCacheByPattern('system:metrics');
        $this->clearCacheByPattern('storage:stats');
    }

    /**
     * Clear information related cache
     */
    public function clearInformationCache(): void
    {
        $this->clearCacheByPattern('information:*');
        $this->clearCacheByPattern('system:metrics');
    }

    /**
     * Clear users related cache
     */
    public function clearUsersCache(): void
    {
        $this->clearCacheByPattern('users:*');
        $this->clearCacheByPattern('system:metrics');
    }

    /**
     * Clear all cache
     */
    public function clearAllCache(): void
    {
        Cache::flush();
        Log::info('All cache cleared');
    }

    /**
     * Clear cache by pattern
     */
    private function clearCacheByPattern(string $pattern): void
    {
        try {
            if (config('cache.default') === 'redis') {
                $keys = Redis::keys($pattern);
                if (!empty($keys)) {
                    Redis::del($keys);
                }
            } else {
                // For file cache, we need to clear specific keys
                $this->clearSpecificKeys($pattern);
            }
        } catch (\Exception $e) {
            Log::error('Failed to clear cache by pattern', [
                'pattern' => $pattern,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Clear specific cache keys
     */
    private function clearSpecificKeys(string $pattern): void
    {
        $keysToClear = [
            self::CACHE_KEYS['PHOTOS_COUNT'],
            self::CACHE_KEYS['INFORMATION_COUNT'],
            self::CACHE_KEYS['USERS_COUNT'],
            self::CACHE_KEYS['SYSTEM_METRICS'],
            self::CACHE_KEYS['STORAGE_STATS'],
            self::CACHE_KEYS['CATEGORY_OPTIONS']
        ];

        foreach ($keysToClear as $key) {
            if (str_contains($pattern, 'photos') && str_contains($key, 'photos')) {
                Cache::forget($key);
            } elseif (str_contains($pattern, 'information') && str_contains($key, 'information')) {
                Cache::forget($key);
            } elseif (str_contains($pattern, 'users') && str_contains($key, 'users')) {
                Cache::forget($key);
            } elseif (str_contains($pattern, 'system') && str_contains($key, 'system')) {
                Cache::forget($key);
            }
        }
    }

    /**
     * Get cache statistics
     */
    public function getCacheStats(): array
    {
        try {
            if (config('cache.default') === 'redis') {
                $info = Redis::info();
                return [
                    'driver' => 'redis',
                    'used_memory' => $info['used_memory_human'] ?? 'N/A',
                    'connected_clients' => $info['connected_clients'] ?? 'N/A',
                    'total_commands_processed' => $info['total_commands_processed'] ?? 'N/A',
                    'keyspace_hits' => $info['keyspace_hits'] ?? 'N/A',
                    'keyspace_misses' => $info['keyspace_misses'] ?? 'N/A'
                ];
            } else {
                return [
                    'driver' => config('cache.default'),
                    'status' => 'active',
                    'note' => 'Statistics not available for this driver'
                ];
            }
        } catch (\Exception $e) {
            return [
                'driver' => config('cache.default'),
                'status' => 'error',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Warm up cache
     */
    public function warmUpCache(): void
    {
        try {
            // Warm up frequently accessed data
            $this->getPhotosCount();
            $this->getInformationCount();
            $this->getUsersCount();
            $this->getRecentPhotos(6);
            $this->getRecentInformation(5);
            $this->getCategoryOptions();
            
            Log::info('Cache warmed up successfully');
        } catch (\Exception $e) {
            Log::error('Failed to warm up cache', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Check if cache is working
     */
    public function isCacheWorking(): bool
    {
        try {
            $testKey = 'cache_test_' . time();
            $testValue = 'test_value';
            
            Cache::put($testKey, $testValue, 60);
            $retrieved = Cache::get($testKey);
            Cache::forget($testKey);
            
            return $retrieved === $testValue;
        } catch (\Exception $e) {
            return false;
        }
    }
}

