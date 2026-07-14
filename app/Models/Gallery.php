<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'slug', 'description'];

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_galleries');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_galleries');
        });
    }
}
