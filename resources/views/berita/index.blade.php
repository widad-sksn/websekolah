@extends('layouts.front')

@section('meta')
<title>Berita & Artikel - {{ config('app.name', 'SchoolCMS') }}</title>
<meta name="description" content="Kumpulan berita, artikel, dan informasi terbaru dari {{ config('app.name', 'SchoolCMS') }}.">
@endsection

@section('content')

<!-- Header Section -->
<section class="bg-slate-900 text-white py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-600 blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-slate-900 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold font-display mb-4">Berita & Artikel</h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto">Ikuti perkembangan terbaru, kegiatan sekolah, dan berbagai informasi menarik lainnya.</p>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Main Content -->
            <div class="lg:w-3/4 order-2 lg:order-1">
                
                <!-- Search & Filter Summary -->
                <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                    <div class="text-gray-600">
                        @if(request('cari'))
                            Menampilkan hasil pencarian untuk: <span class="font-bold text-dark">"{{ request('cari') }}"</span>
                        @elseif(request('kategori'))
                            Kategori: <span class="font-bold text-dark">{{ request('kategori') }}</span>
                        @else
                            Menampilkan semua berita terbaru
                        @endif
                    </div>
                    
                    @if(request('cari') || request('kategori'))
                        <a href="/berita" class="text-sm text-blue-600 hover:text-blue-700 font-medium inline-flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Reset Filter
                        </a>
                    @endif
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($posts as $post)
                    <article class="relative bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group flex flex-col h-full">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <a href="/berita?kategori={{ $post->category->slug }}" class="px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-semibold rounded-full shadow-sm hover:bg-blue-600 hover:text-white transition-colors">
                                    {{ $post->category->name }}
                                </a>
                            </div>
                        </div>
                        <div class="p-6 flex-grow flex flex-col">
                            <div class="flex items-center text-xs text-gray-500 mb-3 space-x-4">
                                <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $post->created_at->format('d M Y') }}</span>
                                <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> {{ $post->views }}</span>
                            </div>
                            <h3 class="text-lg font-bold font-display text-dark mb-3 leading-snug group-hover:text-blue-600 transition-colors">
                                <a href="/berita/{{ $post->slug }}" class="focus:outline-none">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </p>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full bg-white rounded-2xl p-12 text-center border border-gray-100">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-lg font-bold text-dark mb-2">Tidak Ditemukan</h3>
                        <p class="text-gray-500">Maaf, berita yang Anda cari tidak ditemukan.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4 space-y-8 order-1 lg:order-2">
                <!-- Search Widget -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold font-display text-dark mb-4">Cari Berita</h3>
                    <form action="/berita" method="GET">
                        @if(request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif
                        <div class="relative">
                            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Ketik kata kunci..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors bg-gray-50">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Categories Widget -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold font-display text-dark mb-4">Kategori</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="/berita" class="flex items-center justify-between text-sm py-2 {{ !request('kategori') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }}">
                                <span>Semua Berita</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                        <li>
                            <a href="/berita?kategori={{ $category->slug }}" class="flex items-center justify-between text-sm py-2 group {{ request('kategori') == $category->slug ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }}">
                                <span class="flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full mr-2 {{ request('kategori') == $category->slug ? 'bg-blue-600' : 'bg-gray-300 group-hover:bg-blue-400' }} transition-colors"></span>
                                    {{ $category->name }}
                                </span>
                                <span class="px-2 py-0.5 rounded-full bg-gray-100 text-xs font-medium text-gray-500">{{ $category->posts_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
