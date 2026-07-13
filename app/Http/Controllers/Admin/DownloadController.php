<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::latest()->paginate(10);
        return view('admin.downloads.index', compact('downloads'));
    }

    public function create()
    {
        return view('admin.downloads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|max:10240' // max 10MB
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('downloads', $filename, 'public');
            
            Download::create([
                'title' => $validated['title'],
                'file_path' => $path,
                'size' => $file->getSize()
            ]);
        }
        
        return redirect()->route('admin.downloads.index')->with('success', 'File berhasil diupload.');
    }

    public function edit(Download $download)
    {
        return view('admin.downloads.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240'
        ]);

        $data = [
            'title' => $validated['title'],
        ];

        if ($request->hasFile('file')) {
            if ($download->file_path) {
                Storage::disk('public')->delete($download->file_path);
            }
            
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('downloads', $filename, 'public');
            
            $data['file_path'] = $path;
            $data['size'] = $file->getSize();
        }

        $download->update($data);
        
        return redirect()->route('admin.downloads.index')->with('success', 'File berhasil diperbarui.');
    }

    public function destroy(Download $download)
    {
        if ($download->file_path) {
            Storage::disk('public')->delete($download->file_path);
        }
        $download->delete();
        return redirect()->route('admin.downloads.index')->with('success', 'File berhasil dihapus.');
    }
}
