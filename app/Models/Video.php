<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor for URL (reconstructed from youtube_id)
    public function getUrlAttribute()
    {
        return $this->youtube_id ? 'https://www.youtube.com/watch?v=' . $this->youtube_id : '';
    }
}
