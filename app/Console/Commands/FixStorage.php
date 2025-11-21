<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix storage link and create required directories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Fixing storage configuration...');
        $this->newLine();

        // Step 1: Remove old storage link if exists
        $publicStoragePath = public_path('storage');
        if (file_exists($publicStoragePath)) {
            $this->line('1. Removing old storage link...');
            if (is_link($publicStoragePath)) {
                unlink($publicStoragePath);
                $this->info('   ✅ Old symbolic link removed');
            } elseif (is_dir($publicStoragePath)) {
                File::deleteDirectory($publicStoragePath);
                $this->info('   ✅ Old directory removed');
            }
        }

        // Step 2: Create required directories
        $this->line('2. Creating required directories...');
        $directories = [
            storage_path('app/public'),
            storage_path('app/public/photos'),
            storage_path('app/public/thumbnails'),
        ];

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
                $this->info('   ✅ Created: ' . basename($directory));
            } else {
                $this->line('   ℹ️  Already exists: ' . basename($directory));
            }
        }

        // Step 3: Create symbolic link
        $this->newLine();
        $this->line('3. Creating symbolic link...');
        $this->call('storage:link');

        // Step 4: Set proper permissions (Windows compatible)
        $this->newLine();
        $this->line('4. Verifying permissions...');
        foreach ($directories as $directory) {
            if (is_writable($directory)) {
                $this->info('   ✅ Writable: ' . basename($directory));
            } else {
                $this->warn('   ⚠️  Not writable: ' . basename($directory));
            }
        }

        // Step 5: Create .gitignore files
        $this->newLine();
        $this->line('5. Creating .gitignore files...');
        
        $gitignoreContent = "*\n!.gitignore\n";
        
        $gitignorePaths = [
            storage_path('app/public/photos/.gitignore'),
            storage_path('app/public/thumbnails/.gitignore'),
        ];

        foreach ($gitignorePaths as $path) {
            file_put_contents($path, $gitignoreContent);
            $this->info('   ✅ Created .gitignore in ' . basename(dirname($path)));
        }

        $this->newLine();
        $this->info('✨ Storage configuration fixed successfully!');
        $this->newLine();
        $this->line('Next steps:');
        $this->line('  • Run: php artisan storage:verify');
        $this->line('  • Test photo upload in admin dashboard');
        
        return Command::SUCCESS;
    }
}
