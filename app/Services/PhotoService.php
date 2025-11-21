<?php

namespace App\Services;

use App\Models\Photo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoService
{
    /**
     * Create a new photo record
     */
    public function createPhoto(array $data): Photo
    {
        return Photo::create($data);
    }

    /**
     * Update an existing photo record
     */
    public function updatePhoto(Photo $photo, array $data): Photo
    {
        $photo->update($data);
        return $photo->fresh();
    }

    /**
     * Delete a photo and its associated file
     */
    public function deletePhoto(Photo $photo): bool
    {
        // Delete the file first
        $this->deleteFile($photo->file_path);
        
        // Then delete the database record
        return $photo->delete();
    }

    /**
     * Upload a file and return the file path
     */
    public function uploadFile(UploadedFile $file): string
    {
        $this->validateFile($file);
        
        $filename = $this->generateFileName($file);
        $path = $file->storeAs('photos', $filename, 'public');
        
        return $path;
    }

    /**
     * Delete a file from storage
     */
    public function deleteFile(string $filePath): bool
    {
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }
        
        return false;
    }

    /**
     * Get photos by category
     */
    public function getPhotosByCategory(string $category)
    {
        return Photo::where('category', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    /**
     * Search photos by title or description
     */
    public function searchPhotos(string $query)
    {
        return Photo::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    /**
     * Get all photos with pagination
     */
    public function getAllPhotos()
    {
        return Photo::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    /**
     * Get recent photos
     */
    public function getRecentPhotos(int $limit = 6)
    {
        return Photo::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get photos by uploader
     */
    public function getPhotosByUploader(int $userId)
    {
        return Photo::where('uploaded_by', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    /**
     * Validate uploaded file
     */
    private function validateFile(UploadedFile $file): bool
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($file->getMimeType(), $allowedTypes)) {
            throw new \InvalidArgumentException('File type not allowed. Only JPEG, PNG, GIF, and WebP are allowed.');
        }

        if ($file->getSize() > $maxSize) {
            throw new \InvalidArgumentException('File size too large. Maximum size is 5MB.');
        }

        return true;
    }

    /**
     * Generate unique filename
     */
    private function generateFileName(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $timestamp = now()->format('Y-m-d_H-i-s');
        
        return "{$filename}_{$timestamp}.{$extension}";
    }

    /**
     * Get photo statistics
     */
    public function getPhotoStatistics(): array
    {
        return [
            'total_photos' => Photo::count(),
            'photos_by_category' => Photo::selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->pluck('count', 'category')
                ->toArray(),
            'recent_uploads' => Photo::where('created_at', '>=', now()->subDays(7))->count(),
            'storage_used' => $this->calculateStorageUsed(),
        ];
    }

    /**
     * Calculate total storage used by photos
     */
    private function calculateStorageUsed(): int
    {
        $photos = Photo::all();
        $totalSize = 0;

        foreach ($photos as $photo) {
            $filePath = storage_path('app/public/' . $photo->file_path);
            if (file_exists($filePath)) {
                $totalSize += filesize($filePath);
            }
        }

        return $totalSize;
    }
}
