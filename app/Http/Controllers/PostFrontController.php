<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostFrontController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category')->where('status', 'published')->latest();

        if ($request->has('kategori')) {
            $category = Category::where('slug', $request->kategori)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($request->has('cari')) {
            $query->where('title', 'like', '%' . $request->cari . '%');
        }

        $posts = $query->paginate(9)->withQueryString();
        $categories = Category::withCount('posts')->get();

        return view('berita.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::with('category')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        
        $post->increment('views');
        
        $recent_posts = Post::where('id', '!=', $post->id)
                            ->where('status', 'published')
                            ->latest()
                            ->take(4)
                            ->get();

        return view('berita.show', compact('post', 'recent_posts'));
    }
}
