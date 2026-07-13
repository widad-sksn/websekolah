@extends('layouts.admin')

@section('header', 'Edit File Unduhan')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border">
        <h2 class="text-lg font-bold text-dark font-display">Edit Informasi File</h2>
    </div>
    
    <form action="{{ route('admin.downloads.update', $download->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="title" class="block text-sm font-medium text-dark mb-1">Nama / Judul File</label>
            <input type="text" name="title" id="title" value="{{ old('title', $download->title) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>


        <div>
            <label class="block text-sm font-medium text-dark mb-1">Ganti File (Opsional)</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-gray-50">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600 justify-center">
                        <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-blue-500 focus-within:outline-none px-2 py-1">
                            <span>Browse file baru</span>
                            <input id="file" name="file" type="file" class="sr-only">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-2" id="file-name">Biarkan kosong jika tidak ingin mengganti file.</p>
                </div>
            </div>
            @error('file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        
        <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex items-start">
            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="text-sm text-blue-800">
                <p class="font-semibold">File saat ini:</p>
                <p class="mt-1">Ukuran: {{ number_format($download->size / 1024, 2) }} KB</p>
                <a href="{{ Storage::url($download->file_path) }}" target="_blank" class="mt-2 inline-flex items-center font-medium text-blue-600 hover:text-blue-500">
                    Lihat/Download File Saat Ini <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-border">
            <a href="{{ route('admin.downloads.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">Update Data</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.getElementById('file').addEventListener('change', function(e) {
        if(e.target.files.length > 0) {
            document.getElementById('file-name').textContent = 'Akan diganti dengan: ' + e.target.files[0].name;
            document.getElementById('file-name').classList.add('text-primary', 'font-medium');
        } else {
            document.getElementById('file-name').textContent = 'Biarkan kosong jika tidak ingin mengganti file.';
            document.getElementById('file-name').classList.remove('text-primary', 'font-medium');
        }
    });
</script>
@endpush
@endsection
