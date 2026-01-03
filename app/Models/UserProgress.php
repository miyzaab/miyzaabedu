<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        // Polymorphic relationship if needed, or manual lookup
        // Here we store content_type as full class name, so morphTo works if we follow conventions
        // But we named columns content_type and content_id
        return $this->morphTo();
    }
}
