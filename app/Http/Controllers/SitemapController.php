<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Page;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->latest()->get();
        $pages = Page::where('status', 'published')->latest()->get();

        return response()->view('sitemap', compact('posts', 'pages'))->header('Content-Type', 'text/xml');
    }
}
