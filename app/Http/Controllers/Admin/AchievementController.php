<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest('year')->latest()->paginate(10);
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:4',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('achievements', $filename, 'public');
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/' . $path));
            $image->scale(width: 600);
            $image->save(storage_path('app/public/' . $path));
            
            $validated['photo'] = $path;
        }

        Achievement::create($validated);
        
        return redirect()->route('admin.achievements.index')->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:4',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            if ($achievement->photo) {
                Storage::disk('public')->delete($achievement->photo);
            }
            
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('achievements', $filename, 'public');
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/' . $path));
            $image->scale(width: 600);
            $image->save(storage_path('app/public/' . $path));
            
            $validated['photo'] = $path;
        }

        $achievement->update($validated);
        
        return redirect()->route('admin.achievements.index')->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy(Achievement $achievement)
    {
        if ($achievement->photo) {
            Storage::disk('public')->delete($achievement->photo);
        }
        $achievement->delete();
        return redirect()->route('admin.achievements.index')->with('success', 'Data prestasi berhasil dihapus.');
    }
}
