@extends('layouts.admin')

@section('header', 'Tambah Slider')

@section('content')
<div class="max-w-3xl bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border">
        <h2 class="text-lg font-bold text-dark font-display">Informasi Slider</h2>
    </div>
    
    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-dark mb-1">Gambar Slider (Wajib)</label>
                <input type="file" name="image" accept="image/*" required onchange="window.initCropper(this, 16/9)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                <p class="mt-1 text-xs text-muted">Format: JPG, PNG, WEBP. Maks: 3MB. <br><strong class="text-blue-600">Rekomendasi: 1920x1080px (16:9)</strong> agar tidak terpotong. Ukuran bebas tetap bisa diupload, namun sistem akan menyesuaikan (crop) otomatis di perangkat tertentu.</p>
                @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-dark mb-1">Judul Utama (Opsional)</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Contoh: Selamat Datang di Sekolah Kami" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="subtitle" class="block text-sm font-medium text-dark mb-1">Sub Judul / Deskripsi Pendek (Opsional)</label>
                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}" placeholder="Contoh: Membangun Generasi Unggul dan Berakhlak Mulia" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('subtitle') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>


            <div>
                <label for="order" class="block text-sm font-medium text-dark mb-1">Urutan Tampil</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center mt-6">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="status" value="1" {{ old('status', true) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary h-5 w-5">
                    <span class="ml-2 text-sm text-dark font-medium">Aktifkan Slider</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-border">
            <a href="{{ route('admin.sliders.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">Simpan Slider</button>
        </div>
    </form>
</div>
@endsection
