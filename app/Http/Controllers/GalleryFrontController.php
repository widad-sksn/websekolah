<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryFrontController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('images')->latest()->paginate(9);
        return view('galeri.index', compact('galleries'));
    }
}
