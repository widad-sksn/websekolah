@extends('layouts.front')

@section('meta')
<title>Galeri - {{ config('app.name', 'SchoolCMS') }}</title>
<meta name="description" content="Galeri foto kegiatan dan fasilitas {{ config('app.name', 'SchoolCMS') }}.">
@endsection

@section('content')
<section class="bg-slate-900 text-white py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-600 blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-slate-900 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold font-display mb-4">Galeri Kegiatan</h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto">Dokumentasi momen-momen berharga dan fasilitas yang ada di sekolah kami.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($galleries as $gallery)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
                <!-- Cover Image (First Image if exists) -->
                <div class="relative h-64 overflow-hidden bg-gray-200">
                    @if($gallery->images->count() > 0)
                        <img src="{{ Storage::url($gallery->images->first()->image) }}" alt="{{ $gallery->title }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                        <span class="text-white text-sm font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $gallery->images->count() }} Foto
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold font-display text-dark mb-2">{{ $gallery->title }}</h3>
                    @if($gallery->description)
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($gallery->description, 100) }}</p>
                    @endif
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>{{ $gallery->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                
                <!-- Expanded view logic could be added here using AlpineJS (Lightbox) if needed -->
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada galeri foto.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    </div>
</section>
@endsection
