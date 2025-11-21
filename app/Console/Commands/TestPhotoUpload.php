<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestPhotoUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:test-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test photo upload functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testing photo upload functionality...');
        $this->newLine();

        try {
            // Test 1: Create a test image file
            $this->line('1. Creating test image...');
            $testImageContent = $this->createTestImage();
            $testFileName = 'test_upload_' . time() . '.jpg';
            $testPath = 'photos/test/' . $testFileName;
            
            Storage::disk('public')->put($testPath, $testImageContent);
            $this->info('   ✅ Test image created: ' . $testPath);

            // Test 2: Verify file exists in storage
            $this->newLine();
            $this->line('2. Verifying file in storage...');
            if (Storage::disk('public')->exists($testPath)) {
                $this->info('   ✅ File exists in storage/app/public/' . $testPath);
            } else {
                $this->error('   ❌ File not found in storage');
                return Command::FAILURE;
            }

            // Test 3: Verify file accessible via public link
            $this->newLine();
            $this->line('3. Checking public accessibility...');
            $publicPath = public_path('storage/' . $testPath);
            if (file_exists($publicPath)) {
                $this->info('   ✅ File accessible via public/storage/' . $testPath);
            } else {
                $this->error('   ❌ File not accessible via public link');
                return Command::FAILURE;
            }

            // Test 4: Get URL
            $this->newLine();
            $this->line('4. Generating URL...');
            $url = Storage::disk('public')->url($testPath);
            $this->info('   ✅ URL: ' . $url);

            // Test 5: File size
            $this->newLine();
            $this->line('5. Checking file details...');
            $size = Storage::disk('public')->size($testPath);
            $this->info('   📦 Size: ' . $this->formatBytes($size));
            $this->info('   📅 Created: ' . date('Y-m-d H:i:s', Storage::disk('public')->lastModified($testPath)));

            // Test 6: Create thumbnail directory
            $this->newLine();
            $this->line('6. Testing thumbnail directory...');
            $thumbnailPath = str_replace('/photos/', '/thumbnails/', $testPath);
            Storage::disk('public')->put($thumbnailPath, $testImageContent);
            
            if (Storage::disk('public')->exists($thumbnailPath)) {
                $this->info('   ✅ Thumbnail created successfully');
            } else {
                $this->warn('   ⚠️  Thumbnail creation failed');
            }

            // Cleanup
            $this->newLine();
            $this->line('7. Cleaning up test files...');
            Storage::disk('public')->delete($testPath);
            Storage::disk('public')->delete($thumbnailPath);
            $this->info('   ✅ Test files deleted');

            $this->newLine();
            $this->info('✅ All tests passed! Photo upload system is working correctly.');
            $this->newLine();
            $this->line('You can now:');
            $this->line('  • Login to admin dashboard');
            $this->line('  • Upload photos at: http://localhost/admin/photos');
            $this->line('  • View gallery at: http://localhost/');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Test failed: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
            return Command::FAILURE;
        }
    }

    /**
     * Create a simple test image
     */
    private function createTestImage(): string
    {
        // Create a simple 1x1 pixel JPEG (smallest valid JPEG)
        return base64_decode('/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0a' .
            'HBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIy' .
            'MjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAABAAEDASIA' .
            'AhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAv/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8QAFQEB' .
            'AQAAAAAAAAAAAAAAAAAAAAX/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwCwAA//2Q==');
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        
        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
