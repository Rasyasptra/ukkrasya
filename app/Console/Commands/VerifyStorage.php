<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class VerifyStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify storage link and directory structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Verifying storage configuration...');
        $this->newLine();

        // Check symbolic link
        $publicStoragePath = public_path('storage');
        $storagePublicPath = storage_path('app/public');

        $this->info('1. Checking symbolic link:');
        if (file_exists($publicStoragePath)) {
            // Check if it's a junction/symlink (Windows compatible)
            if (is_link($publicStoragePath) || $this->isJunction($publicStoragePath)) {
                $this->line('   ✅ Storage link exists and is functional');
                $this->line('   📁 public/storage -> storage/app/public');
            } else {
                $this->line('   ✅ Storage path exists: ' . $publicStoragePath);
                $this->line('   ℹ️  Junction/symlink status: Checking accessibility...');
                // Even if not detected as link, check if it's functional
                if ($this->testStorageAccess($publicStoragePath)) {
                    $this->line('   ✅ Storage is functional (junction working)');
                } else {
                    $this->warn('   ⚠️  Path exists but storage may not be functional');
                    $this->line('   Run: php artisan storage:link');
                }
            }
        } else {
            $this->error('   ❌ Storage link does not exist');
            $this->line('   Run: php artisan storage:link');
        }

        $this->newLine();

        // Check required directories
        $this->info('2. Checking required directories:');
        $directories = [
            'storage/app/public' => $storagePublicPath,
            'storage/app/public/photos' => storage_path('app/public/photos'),
            'storage/app/public/thumbnails' => storage_path('app/public/thumbnails'),
        ];

        foreach ($directories as $name => $path) {
            if (is_dir($path)) {
                $this->line("   ✅ {$name}");
                
                // Check if writable
                if (is_writable($path)) {
                    $this->line("      📝 Writable");
                } else {
                    $this->warn("      ⚠️  Not writable");
                }
            } else {
                $this->error("   ❌ {$name} - Directory not found");
                $this->line("      Creating directory...");
                mkdir($path, 0755, true);
                $this->info("      ✅ Directory created");
            }
        }

        $this->newLine();

        // Check disk configuration
        $this->info('3. Checking disk configuration:');
        $publicDisk = config('filesystems.disks.public');
        $this->line('   Root: ' . $publicDisk['root']);
        $this->line('   URL: ' . $publicDisk['url']);
        $this->line('   Visibility: ' . $publicDisk['visibility']);

        $this->newLine();

        // Test storage access
        $this->info('4. Testing storage access:');
        try {
            $testFile = 'test_' . time() . '.txt';
            Storage::disk('public')->put($testFile, 'Storage test');
            
            if (Storage::disk('public')->exists($testFile)) {
                $this->line('   ✅ Can write to storage');
                
                $url = Storage::disk('public')->url($testFile);
                $this->line('   URL would be: ' . $url);
                
                Storage::disk('public')->delete($testFile);
                $this->line('   ✅ Can delete from storage');
            }
        } catch (\Exception $e) {
            $this->error('   ❌ Storage test failed: ' . $e->getMessage());
        }

        $this->newLine();

        // Check photo statistics
        $this->info('5. Photo storage statistics:');
        $photosPath = storage_path('app/public/photos');
        $thumbnailsPath = storage_path('app/public/thumbnails');
        
        if (is_dir($photosPath)) {
            $photoCount = count(glob($photosPath . '/*.*'));
            $this->line('   📸 Photos: ' . $photoCount);
        }
        
        if (is_dir($thumbnailsPath)) {
            $thumbnailCount = count(glob($thumbnailsPath . '/*.*'));
            $this->line('   🖼️  Thumbnails: ' . $thumbnailCount);
        }

        $this->newLine();
        $this->info('✨ Storage verification complete!');
        
        return Command::SUCCESS;
    }

    /**
     * Check if path is a Windows junction point
     */
    private function isJunction(string $path): bool
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            return false;
        }

        if (!file_exists($path) || !is_dir($path)) {
            return false;
        }

        // Test if the junction works by checking file accessibility
        $testFile = uniqid('junction_test_') . '.tmp';
        $sourcePath = storage_path('app/public/' . $testFile);
        $linkPath = $path . '/' . $testFile;
        
        try {
            // Create a test file in storage/app/public
            file_put_contents($sourcePath, 'test');
            
            // Check if it's accessible through the link
            $accessible = file_exists($linkPath) && file_get_contents($linkPath) === 'test';
            
            // Clean up
            @unlink($sourcePath);
            
            return $accessible;
        } catch (\Exception $e) {
            @unlink($sourcePath);
            return false;
        }
    }

    /**
     * Test storage access functionality
     */
    private function testStorageAccess(string $path): bool
    {
        $testFile = uniqid('access_test_') . '.tmp';
        $sourcePath = storage_path('app/public/' . $testFile);
        $linkPath = $path . DIRECTORY_SEPARATOR . $testFile;
        
        try {
            file_put_contents($sourcePath, 'test');
            $accessible = file_exists($linkPath);
            @unlink($sourcePath);
            return $accessible;
        } catch (\Exception $e) {
            @unlink($sourcePath);
            return false;
        }
    }
}
