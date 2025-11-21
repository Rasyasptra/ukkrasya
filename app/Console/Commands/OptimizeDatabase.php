<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tools\DatabaseOptimizer;
use App\Tools\CacheManager;

class OptimizeDatabase extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'db:optimize 
                            {--analyze : Run ANALYZE TABLE on all tables}
                            {--indexes : Create recommended indexes}
                            {--cleanup : Clean up old data}
                            {--all : Run all optimization tasks}';

    /**
     * The console command description.
     */
    protected $description = 'Optimize database performance by analyzing tables, creating indexes, and cleaning up data';

    protected $optimizer;
    protected $cacheManager;

    public function __construct()
    {
        parent::__construct();
        $this->optimizer = new DatabaseOptimizer();
        $this->cacheManager = new CacheManager();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database optimization...');

        if ($this->option('all') || $this->option('analyze')) {
            $this->analyzeTables();
        }

        if ($this->option('all') || $this->option('indexes')) {
            $this->createIndexes();
        }

        if ($this->option('all') || $this->option('cleanup')) {
            $this->cleanupData();
        }

        // Always optimize tables
        $this->optimizeTables();

        // Clear cache
        $this->clearCache();

        $this->info('Database optimization completed!');
    }

    /**
     * Analyze database tables
     */
    private function analyzeTables()
    {
        $this->info('Analyzing database tables...');
        
        $results = $this->optimizer->analyzeTables();
        
        $this->table(['Table', 'Status', 'Duration (ms)'], 
            collect($results)->map(function ($result, $table) {
                return [
                    $table,
                    $result['status'],
                    $result['duration_ms'] ?? 'N/A'
                ];
            })
        );
    }

    /**
     * Create recommended indexes
     */
    private function createIndexes()
    {
        $this->info('Checking for missing indexes...');
        
        $recommendations = $this->optimizer->checkMissingIndexes();
        
        if (empty($recommendations)) {
            $this->info('No missing indexes found.');
            return;
        }

        $this->table(['Table', 'Column', 'Type', 'Reason'], 
            collect($recommendations)->map(function ($rec) {
                return [
                    $rec['table'],
                    $rec['column'],
                    $rec['type'],
                    $rec['reason']
                ];
            })
        );

        if ($this->confirm('Do you want to create these indexes?')) {
            $this->info('Creating indexes...');
            
            $results = $this->optimizer->createRecommendedIndexes();
            
            $this->table(['Table', 'Index', 'Column', 'Status'], 
                collect($results)->map(function ($result) {
                    return [
                        $result['table'],
                        $result['index'],
                        $result['column'],
                        $result['status']
                    ];
                })
            );
        }
    }

    /**
     * Clean up old data
     */
    private function cleanupData()
    {
        $this->info('Cleaning up old data...');
        
        $results = $this->optimizer->cleanupOldData();
        
        foreach ($results as $type => $result) {
            if (isset($result['error'])) {
                $this->error("Error cleaning up {$type}: {$result['error']}");
            } else {
                $this->info("Cleaned up {$type}: {$result['count']} records {$result['action']}");
            }
        }
    }

    /**
     * Optimize database tables
     */
    private function optimizeTables()
    {
        $this->info('Optimizing database tables...');
        
        $results = $this->optimizer->optimizeTables();
        
        $this->table(['Table', 'Status', 'Duration (ms)'], 
            collect($results)->map(function ($result, $table) {
                return [
                    $table,
                    $result['status'],
                    $result['duration_ms'] ?? 'N/A'
                ];
            })
        );
    }

    /**
     * Clear cache
     */
    private function clearCache()
    {
        $this->info('Clearing cache...');
        
        $this->cacheManager->clearAllCache();
        
        $this->info('Cache cleared successfully.');
    }
}

