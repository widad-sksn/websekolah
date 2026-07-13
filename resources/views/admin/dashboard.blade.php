@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Stats Cards -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-border flex items-center justify-between group hover:shadow-md transition-shadow">
        <div>
            <p class="text-sm font-medium text-muted mb-1">Total Berita</p>
            <h3 class="text-3xl font-bold text-dark font-display">{{ $stats['posts_count'] }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path></svg>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-border flex items-center justify-between group hover:shadow-md transition-shadow">
        <div>
            <p class="text-sm font-medium text-muted mb-1">Total Guru</p>
            <h3 class="text-3xl font-bold text-dark font-display">{{ $stats['teachers_count'] }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-sky-50 flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-border flex items-center justify-between group hover:shadow-md transition-shadow">
        <div>
            <p class="text-sm font-medium text-muted mb-1">Album Galeri</p>
            <h3 class="text-3xl font-bold text-dark font-display">{{ $stats['galleries_count'] }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-success group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-border flex items-center justify-between group hover:shadow-md transition-shadow">
        <div>
            <p class="text-sm font-medium text-muted mb-1">Status PPDB</p>
            <div class="mt-1 flex items-center">
                @if($ppdb_status == '1')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Buka
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Tutup
                    </span>
                @endif
            </div>
        </div>
        <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-warning group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Latest Posts -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
        <div class="px-6 py-4 border-b border-border flex justify-between items-center">
            <h2 class="text-lg font-bold text-dark font-display">Berita Terbaru</h2>
            <a href="{{ route('admin.posts.index') }}" class="text-sm font-medium text-primary hover:text-blue-700">Lihat Semua &rarr;</a>
        </div>
        <div class="divide-y divide-border">
            @forelse($latest_posts as $post)
            <div class="p-6 flex items-center hover:bg-gray-50 transition-colors">
                <div class="w-16 h-16 rounded-xl bg-gray-100 mr-4 flex-shrink-0 bg-cover bg-center" @if($post->thumbnail) style="background-image: url('{{ Storage::url($post->thumbnail) }}')" @endif></div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-base font-semibold text-dark truncate">{{ $post->title }}</h4>
                    <p class="text-sm text-muted mt-1">{{ $post->created_at->diffForHumans() }} &bull; {{ $post->category->name ?? 'Uncategorized' }}</p>
                </div>
                <div class="ml-4 flex-shrink-0">
                    @if($post->status == 'published')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Published</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Draft</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-muted">
                Belum ada berita.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm border border-border">
        <div class="px-6 py-4 border-b border-border">
            <h2 class="text-lg font-bold text-dark font-display">Aksi Cepat</h2>
        </div>
        <div class="p-6 grid grid-cols-2 gap-4">
            <a href="{{ route('admin.posts.create') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-border hover:border-primary hover:bg-blue-50 transition-colors group">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <span class="text-sm font-medium text-dark">Tulis Berita</span>
            </a>
            
            <a href="{{ route('admin.galleries.create') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-border hover:border-secondary hover:bg-sky-50 transition-colors group">
                <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-white transition-colors mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="text-sm font-medium text-dark">Upload Galeri</span>
            </a>

            @role('Super Admin|Admin Sekolah')
            <a href="{{ route('admin.settings.index') }}" class="col-span-2 flex items-center p-4 rounded-xl border border-border hover:border-gray-300 hover:bg-gray-50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-muted mr-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-dark">Pengaturan Website</h4>
                    <p class="text-xs text-muted mt-0.5">Ubah identitas, logo & warna</p>
                </div>
                <div class="ml-auto text-muted">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>
            @endrole
        </div>
    </div>
</div>
@endsection
