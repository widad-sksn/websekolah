<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('order')->orderBy('name')->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'order' => 'integer',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('teachers', $filename, 'public');
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/' . $path));
            $image->scale(width: 400);
            $image->save(storage_path('app/public/' . $path));
            
            $validated['photo'] = $path;
        }

        Teacher::create($validated);
        
        return redirect()->route('admin.teachers.index')->with('success', 'Data guru/staff berhasil ditambahkan.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'order' => 'integer',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('teachers', $filename, 'public');
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/' . $path));
            $image->scale(width: 400);
            $image->save(storage_path('app/public/' . $path));
            
            $validated['photo'] = $path;
        }

        $teacher->update($validated);
        
        return redirect()->route('admin.teachers.index')->with('success', 'Data guru/staff berhasil diperbarui.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Data guru/staff berhasil dihapus.');
    }
}
