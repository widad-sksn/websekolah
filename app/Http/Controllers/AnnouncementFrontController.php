<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementFrontController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->paginate(10);
        return view('pengumuman.index', compact('announcements'));
    }
}
