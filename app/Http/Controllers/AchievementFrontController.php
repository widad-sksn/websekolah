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

    public function show($id)
    {
        $achievement = Achievement::findOrFail($id);
        $recent_achievements = Achievement::where('id', '!=', $id)->latest()->take(4)->get();
        return view('prestasi.show', compact('achievement', 'recent_achievements'));
    }
}
