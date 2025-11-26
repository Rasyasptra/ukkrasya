<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'filename',
        'file_path',
        'uploaded_by',
        'category'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function isLikedByIp($ipAddress)
    {
        return $this->likes()->where('ip_address', $ipAddress)->exists();
    }

    /**
     * Check if the photo is liked by the authenticated user
     */
    public function isLikedByUser($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }
        
        if (!$userId) {
            return false;
        }
        
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Get the photo URL
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->file_path && Storage::disk('public')->exists($this->file_path)) {
            return asset('storage/' . $this->file_path);
        }
        
        // Fallback to default image if file doesn't exist
        return asset('images/no-image.png');
    }

    /**
     * Get the photo thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->photo_url;
    }
}
