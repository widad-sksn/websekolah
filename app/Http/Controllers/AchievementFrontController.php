<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;

class AchievementFrontController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->paginate(12);
        return view('prestasi.index', compact('achievements'));
    }
}
