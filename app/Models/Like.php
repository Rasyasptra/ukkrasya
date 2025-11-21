<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'user_id',
        'ip_address',
        'user_agent'
    ];

    /**
     * Get the photo that owns the like
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    /**
     * Get the user that owns the like
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
