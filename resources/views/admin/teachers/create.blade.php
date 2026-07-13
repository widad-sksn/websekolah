@extends('layouts.admin')

@section('header', 'Tambah Data Guru & Staff')

@section('content')
<div class="max-w-3xl bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border">
        <h2 class="text-lg font-bold text-dark font-display">Informasi Guru/Staff</h2>
    </div>
    
    <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-medium text-dark mb-1">Nama Lengkap (beserta gelar)</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="nip" class="block text-sm font-medium text-dark mb-1">NIP (Opsional)</label>
                <input type="text" name="nip" id="nip" value="{{ old('nip') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('nip') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="position" class="block text-sm font-medium text-dark mb-1">Jabatan</label>
                <input type="text" name="position" id="position" value="{{ old('position') }}" placeholder="Contoh: Kepala Sekolah / Guru" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('position') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-dark mb-1">Mata Pelajaran (Opsional)</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" placeholder="Contoh: Matematika" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('subject') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="order" class="block text-sm font-medium text-dark mb-1">Urutan Tampil</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                <p class="mt-1 text-xs text-muted">Angka lebih kecil tampil lebih awal (contoh Kepala Sekolah: 1)</p>
                @error('order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-dark mb-1">Pas Foto (Opsional)</label>
                <input type="file" name="photo" accept="image/*" onchange="window.initCropper(this, 3/4)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                <p class="mt-1 text-xs text-muted">Format: JPG, PNG, WEBP. Maks: 2MB. Disarankan pas foto rasio 3:4.</p>
                @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-border">
            <a href="{{ route('admin.teachers.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
