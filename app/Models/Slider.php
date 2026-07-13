<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'subtitle', 'image', 'status', 'order'];

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_sliders');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_sliders');
        });
    }
}
