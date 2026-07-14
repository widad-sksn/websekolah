<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Post;
use App\Models\Achievement;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = \Illuminate\Support\Facades\Cache::remember('home_sliders', 3600, function () {
            return Slider::where('status', true)->orderBy('order')->take(5)->get();
        });
        
        $recent_posts = \Illuminate\Support\Facades\Cache::remember('home_recent_posts', 3600, function () {
            return Post::with('category')->where('status', 'published')->latest()->take(8)->get();
        });
        
        $achievements = \Illuminate\Support\Facades\Cache::remember('home_achievements', 3600, function () {
            return Achievement::latest()->take(4)->get();
        });
        
        $galleries = \Illuminate\Support\Facades\Cache::remember('home_galleries', 3600, function () {
            return Gallery::with('images')->latest()->take(4)->get();
        });
        
        $welcome_image = \App\Models\Setting::where('key', 'welcome_image')->value('value');

        return view('home', compact('sliders', 'recent_posts', 'achievements', 'galleries', 'welcome_image'));
    }
}
