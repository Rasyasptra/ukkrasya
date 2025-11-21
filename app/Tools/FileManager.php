<?php

namespace App\Tools;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FileManager
{
    /**
     * Allowed image types
     */
    private const ALLOWED_IMAGE_TYPES = [
        'image/jpeg',
        'image/png', 
        'image/gif',
        'image/webp',
        'image/svg+xml'
    ];

    /**
     * Maximum file size in bytes (5MB)
     */
    private const MAX_FILE_SIZE = 5 * 1024 * 1024;

    /**
     * Image quality for compression
     */
    private const IMAGE_QUALITY = 85;

    /**
     * Upload and process image file
     */
    public function uploadImage(UploadedFile $file, string $category = 'general'): array
    {
        $this->validateImage($file);
        
        $filename = $this->generateFilename($file);
        $path = "photos/{$category}/" . date('Y/m');
        
        // Store original file
        $originalPath = $file->storeAs($path, $filename, 'public');
        
        // Create thumbnail
        $thumbnailPath = $this->createThumbnail($originalPath, $filename);
        
        // Get file info
        $fileInfo = $this->getFileInfo($originalPath);
        
        return [
            'original_path' => $originalPath,
            'thumbnail_path' => $thumbnailPath,
            'filename' => $filename,
            'file_size' => $fileInfo['size'],
            'dimensions' => $fileInfo['dimensions'],
            'mime_type' => $fileInfo['mime_type']
        ];
    }

    /**
     * Validate uploaded image
     */
    private function validateImage(UploadedFile $file): void
    {
        // Check file type
        if (!in_array($file->getMimeType(), self::ALLOWED_IMAGE_TYPES)) {
            throw new \InvalidArgumentException(
                'File type not allowed. Only JPEG, PNG, GIF, WebP, and SVG are allowed.'
            );
        }

        // Check file size
        if ($file->getSize() > self::MAX_FILE_SIZE) {
            throw new \InvalidArgumentException(
                'File size too large. Maximum size is 5MB.'
            );
        }

        // Additional validation for images
        if (str_starts_with($file->getMimeType(), 'image/') && $file->getMimeType() !== 'image/svg+xml') {
            $imageInfo = getimagesize($file->getPathname());
            if ($imageInfo === false) {
                throw new \InvalidArgumentException('Invalid image file.');
            }
        }
    }

    /**
     * Generate unique filename
     */
    private function generateFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $basename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $timestamp = now()->format('Y-m-d_H-i-s');
        $random = Str::random(8);
        
        return "{$basename}_{$timestamp}_{$random}.{$extension}";
    }

    /**
     * Create thumbnail for image
     */
    private function createThumbnail(string $originalPath, string $filename): ?string
    {
        try {
            $fullPath = Storage::disk('public')->path($originalPath);
            $mimeType = mime_content_type($fullPath);
            
            // Skip thumbnail creation for SVG
            if ($mimeType === 'image/svg+xml') {
                return null;
            }

            $thumbnailPath = str_replace('/photos/', '/thumbnails/', $originalPath);
            $thumbnailFullPath = Storage::disk('public')->path($thumbnailPath);
            
            // Ensure directory exists
            $thumbnailDir = dirname($thumbnailFullPath);
            if (!is_dir($thumbnailDir)) {
                mkdir($thumbnailDir, 0755, true);
            }

            // Create thumbnail using Intervention Image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($fullPath);
            $image->scale(300, 300);
            $image->save($thumbnailFullPath, quality: self::IMAGE_QUALITY);

            return $thumbnailPath;
        } catch (\Exception $e) {
            \Log::warning('Failed to create thumbnail', [
                'original_path' => $originalPath,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Get file information
     */
    private function getFileInfo(string $path): array
    {
        $fullPath = Storage::disk('public')->path($path);
        
        $info = [
            'size' => filesize($fullPath),
            'mime_type' => mime_content_type($fullPath),
            'dimensions' => null
        ];

        // Get image dimensions
        if (str_starts_with($info['mime_type'], 'image/')) {
            $imageInfo = getimagesize($fullPath);
            if ($imageInfo !== false) {
                $info['dimensions'] = [
                    'width' => $imageInfo[0],
                    'height' => $imageInfo[1]
                ];
            }
        }

        return $info;
    }

    /**
     * Delete file and its thumbnail
     */
    public function deleteFile(string $filePath): bool
    {
        $deleted = true;
        
        // Delete original file
        if (Storage::disk('public')->exists($filePath)) {
            $deleted = Storage::disk('public')->delete($filePath);
        }
        
        // Delete thumbnail
        $thumbnailPath = str_replace('/photos/', '/thumbnails/', $filePath);
        if (Storage::disk('public')->exists($thumbnailPath)) {
            Storage::disk('public')->delete($thumbnailPath);
        }
        
        return $deleted;
    }

    /**
     * Get file URL
     */
    public function getFileUrl(string $filePath): string
    {
        return Storage::disk('public')->url($filePath);
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrl(string $filePath): ?string
    {
        $thumbnailPath = str_replace('/photos/', '/thumbnails/', $filePath);
        
        if (Storage::disk('public')->exists($thumbnailPath)) {
            return Storage::disk('public')->url($thumbnailPath);
        }
        
        return null;
    }

    /**
     * Clean up orphaned files
     */
    public function cleanupOrphanedFiles(): int
    {
        $deletedCount = 0;
        $photosPath = Storage::disk('public')->path('photos');
        $thumbnailsPath = Storage::disk('public')->path('thumbnails');
        
        // Get all photo files
        $photoFiles = $this->getAllFiles($photosPath);
        
        foreach ($photoFiles as $photoFile) {
            $relativePath = str_replace($photosPath . '/', '', $photoFile);
            $relativePath = 'photos/' . $relativePath;
            
            // Check if file exists in database
            $existsInDb = \App\Models\Photo::where('file_path', $relativePath)->exists();
            
            if (!$existsInDb) {
                if ($this->deleteFile($relativePath)) {
                    $deletedCount++;
                }
            }
        }
        
        return $deletedCount;
    }

    /**
     * Get all files recursively
     */
    private function getAllFiles(string $directory): array
    {
        $files = [];
        
        if (is_dir($directory)) {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($directory)
            );
            
            foreach ($iterator as $file) {
                if ($file->isFile()) {
                    $files[] = $file->getPathname();
                }
            }
        }
        
        return $files;
    }

    /**
     * Get storage statistics
     */
    public function getStorageStats(): array
    {
        $photosPath = Storage::disk('public')->path('photos');
        $thumbnailsPath = Storage::disk('public')->path('thumbnails');
        
        return [
            'photos_count' => count($this->getAllFiles($photosPath)),
            'thumbnails_count' => count($this->getAllFiles($thumbnailsPath)),
            'photos_size' => $this->getDirectorySize($photosPath),
            'thumbnails_size' => $this->getDirectorySize($thumbnailsPath),
            'total_size' => $this->getDirectorySize($photosPath) + $this->getDirectorySize($thumbnailsPath)
        ];
    }

    /**
     * Get directory size
     */
    private function getDirectorySize(string $directory): int
    {
        $size = 0;
        
        if (is_dir($directory)) {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($directory)
            );
            
            foreach ($iterator as $file) {
                if ($file->isFile()) {
                    $size += $file->getSize();
                }
            }
        }
        
        return $size;
    }
}

