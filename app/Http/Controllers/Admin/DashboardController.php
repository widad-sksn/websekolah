<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Teacher;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts_count' => Post::count(),
            'galleries_count' => Gallery::count(),
            'teachers_count' => Teacher::count(),
            'visitors_count' => 0, // Placeholder
        ];
        
        $ppdb_status = Setting::where('key', 'ppdb_status')->first()->value ?? '0';
        $latest_posts = Post::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'ppdb_status', 'latest_posts'));
    }
}
