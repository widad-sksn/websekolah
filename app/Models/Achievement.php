<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = ['title', 'category', 'level', 'year', 'description', 'photo'];

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_achievements');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_achievements');
        });
    }
}
