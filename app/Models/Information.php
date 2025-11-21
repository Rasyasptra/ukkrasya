<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'information';

    protected $fillable = [
        'title',
        'content',
        'type',
        'priority',
        'is_published',
        'published_at',
        'expires_at',
        'created_by'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getStatusAttribute()
    {
        if (!$this->is_published) return 'draft';
        if ($this->expires_at && $this->expires_at->isPast()) return 'expired';
        return 'published';
    }
}
