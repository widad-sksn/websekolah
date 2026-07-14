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
            <a href="{{ route('galeri.show', $gallery->slug) }}" class="relative block h-[20rem] md:h-auto md:aspect-square rounded-2xl overflow-hidden group cursor-pointer shadow-sm hover:shadow-xl transition-all">
                @if($gallery->images->count() > 0)
                    <img src="{{ Storage::url($gallery->images->first()->image) }}" alt="{{ $gallery->title }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="absolute inset-0 w-full h-full bg-slate-800 flex items-center justify-center">
                        <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-transparent"></div>
                
                <!-- Content Overlay -->
                <div class="absolute bottom-0 left-0 w-full p-4 md:p-6 text-left">
                    <div class="inline-flex items-center justify-center px-2.5 py-1 md:px-3 md:py-1 bg-white/20 backdrop-blur-md border border-white/30 rounded-lg mb-2 md:mb-3">
                        <span class="text-white text-[10px] md:text-xs font-bold uppercase tracking-wider leading-none pt-0.5">{{ $gallery->images->count() }} Foto</span>
                    </div>
                    <h3 class="font-bold text-white text-lg md:text-xl mb-1.5 md:mb-2 leading-tight group-hover:text-blue-300 transition-colors">{{ $gallery->title }}</h3>
                    @if($gallery->description)
                        <p class="text-slate-300 text-xs md:text-sm line-clamp-2 mb-3">
                            {{ Str::limit($gallery->description, 80) }}
                        </p>
                    @endif
                    <div class="text-blue-300 text-[10px] md:text-xs font-medium flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $gallery->created_at->format('d M Y') }}
                    </div>
                </div>
            </a>
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
