@extends('layouts.admin')

@section('header', 'Galeri Sekolah')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border flex justify-between items-center">
        <h2 class="text-lg font-bold text-dark font-display">Album Galeri</h2>
        <a href="{{ route('admin.galleries.create') }}" class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors">
            + Tambah Album
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        @forelse($galleries as $gallery)
        <div class="bg-white rounded-xl border border-border overflow-hidden hover:shadow-md transition-shadow group">
            <div class="aspect-w-16 aspect-h-10 bg-gray-100 relative">
                @if($gallery->images->count() > 0)
                    <img src="{{ Storage::url($gallery->images->first()->image) }}" alt="{{ $gallery->title }}" class="object-cover w-full h-full">
                @else
                    <div class="flex items-center justify-center w-full h-full text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="px-4 py-2 bg-white text-dark font-medium rounded-lg text-sm mx-1 hover:bg-gray-100">Edit</a>
                    <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Hapus album beserta seluruh fotonya?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg text-sm mx-1 hover:bg-red-700">Hapus</button>
                    </form>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-bold text-dark font-display truncate">{{ $gallery->title }}</h3>
                <p class="text-sm text-muted mt-1 truncate">{{ $gallery->description ?? 'Tidak ada deskripsi' }}</p>
                <div class="mt-3 flex items-center justify-between text-xs text-muted">
                    <span>{{ $gallery->images_count }} Foto</span>
                    <span>{{ $gallery->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 text-center text-muted">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <p>Belum ada album galeri.</p>
        </div>
        @endforelse
    </div>
    
    @if($galleries->hasPages())
    <div class="px-6 py-4 border-t border-border">
        {{ $galleries->links() }}
    </div>
    @endif
</div>
@endsection
