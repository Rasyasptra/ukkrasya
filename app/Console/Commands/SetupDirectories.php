<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupDirectories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup all required directories and clear caches';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Setting up application directories...');
        $this->newLine();

        // Required directories
        $directories = [
            'bootstrap/cache',
            'storage/app/public',
            'storage/app/public/photos',
            'storage/app/public/thumbnails',
            'storage/framework/cache',
            'storage/framework/cache/data',
            'storage/framework/sessions',
            'storage/framework/views',
            'storage/logs',
        ];

        $this->line('1. Creating required directories...');
        foreach ($directories as $directory) {
            $path = base_path($directory);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
                $this->info('   ✅ Created: ' . $directory);
            } else {
                $this->line('   ℹ️  Already exists: ' . $directory);
            }
        }

        // Create .gitignore files
        $this->newLine();
        $this->line('2. Creating .gitignore files...');
        
        $gitignoreContent = "*\n!.gitignore\n";
        $gitignoreDirs = [
            'storage/framework/cache',
            'storage/framework/sessions',
            'storage/framework/views',
            'storage/app/public/photos',
            'storage/app/public/thumbnails',
        ];

        foreach ($gitignoreDirs as $dir) {
            $gitignorePath = base_path($dir . '/.gitignore');
            if (!file_exists($gitignorePath)) {
                file_put_contents($gitignorePath, $gitignoreContent);
                $this->info('   ✅ Created .gitignore in ' . $dir);
            }
        }

        // Clear all caches
        $this->newLine();
        $this->line('3. Clearing caches...');
        $this->call('config:clear');
        $this->call('cache:clear');
        $this->call('view:clear');
        $this->call('route:clear');

        // Setup storage link
        $this->newLine();
        $this->line('4. Setting up storage link...');
        if (!file_exists(public_path('storage'))) {
            $this->call('storage:link');
        } else {
            $this->line('   ℹ️  Storage link already exists');
        }

        // Cache config
        $this->newLine();
        $this->line('5. Caching configuration...');
        $this->call('config:cache');

        $this->newLine();
        $this->info('✅ Application setup completed successfully!');
        $this->newLine();
        $this->line('Next steps:');
        $this->line('  • Run: php artisan serve');
        $this->line('  • Visit: http://localhost:8000');

        return Command::SUCCESS;
    }
}
