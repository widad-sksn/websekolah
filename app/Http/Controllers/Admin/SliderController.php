<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'status' => 'boolean',
            'order' => 'integer',
            'image' => 'required|image|max:51200'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('sliders', $filename, 'public');
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/' . $path));
            $image->scale(width: 1920);
            $image->save(storage_path('app/public/' . $path));
            
            $validated['image'] = $path;
        }

        $validated['status'] = $request->has('status') ? true : false;
        
        Slider::create($validated);
        
        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'status' => 'boolean',
            'order' => 'integer',
            'image' => 'nullable|image|max:51200'
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('sliders', $filename, 'public');
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/' . $path));
            $image->scale(width: 1920);
            $image->save(storage_path('app/public/' . $path));
            
            $validated['image'] = $path;
        }

        $validated['status'] = $request->has('status') ? true : false;

        $slider->update($validated);
        
        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil dihapus.');
    }
}
