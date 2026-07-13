@extends('layouts.admin')

@section('header', 'Edit Kategori')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border">
        <h2 class="text-lg font-bold text-dark font-display">Edit Kategori</h2>
    </div>
    
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-dark mb-1">Nama Kategori</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3 mt-8">
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">Update Kategori</button>
        </div>
    </form>
</div>
@endsection
