@extends('layouts.admin')

@section('header', 'Tambah Data Prestasi')

@section('content')
<div class="max-w-3xl bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border">
        <h2 class="text-lg font-bold text-dark font-display">Informasi Prestasi</h2>
    </div>
    
    <form action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-dark mb-1">Nama Prestasi / Juara</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Contoh: Juara 1 Olimpiade Matematika Nasional" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-dark mb-1">Bidang / Kategori</label>
                <input type="text" name="category" id="category" value="{{ old('category') }}" placeholder="Contoh: Akademik" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('category') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="level" class="block text-sm font-medium text-dark mb-1">Tingkat</label>
                <input type="text" name="level" id="level" value="{{ old('level') }}" placeholder="Contoh: Nasional" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('level') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="year" class="block text-sm font-medium text-dark mb-1">Tahun</label>
                <input type="text" name="year" id="year" value="{{ old('year') }}" placeholder="Contoh: 2023" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('year') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-dark mb-1">Deskripsi Singkat (Opsional)</label>
                <textarea name="description" id="description" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-dark mb-1">Foto/Dokumentasi (Opsional)</label>
                <input type="file" name="photo" accept="image/*" onchange="window.initCropper(this, 4/3)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                <p class="mt-1 text-xs text-muted">Format: JPG, PNG, WEBP. Maks: 50MB.</p>
                @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-border">
            <a href="{{ route('admin.achievements.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">Simpan Prestasi</button>
        </div>
    </form>
</div>
@endsection
