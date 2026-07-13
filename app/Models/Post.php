<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'thumbnail', 'status', 'is_featured', 
        'published_at', 'user_id', 'category_id', 'meta_title', 'meta_description'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_recent_posts');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_recent_posts');
        });
    }
}
