@extends('layouts.front')

@section('content')

<!-- Hero Slider Section -->
@if($sliders->count() > 0)
<div class="container mx-auto px-4 mt-6 md:mt-8 mb-12">
    <div class="relative w-full aspect-video overflow-hidden bg-slate-900 group rounded-3xl shadow-2xl ring-1 ring-gray-900/5" x-data="slider()">
        <!-- Slides -->
        <div class="relative h-full">
            @foreach($sliders as $index => $slider)
            <div x-show="activeSlide === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-700" 
                 x-transition:enter-start="opacity-0 scale-105" 
                 x-transition:enter-end="opacity-100 scale-100" 
                 x-transition:leave="transition ease-in duration-500" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="absolute inset-0"
                 style="display: none;">
                
                <img src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}" class="absolute inset-0 w-full h-full object-cover object-top">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/40 to-transparent"></div>

                <!-- Content -->
                <div class="absolute inset-0 flex items-center">
                    <div class="container mx-auto px-8 md:px-16">
                        <div class="max-w-3xl">
                            @if($slider->title)
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display text-white leading-tight mb-4 opacity-0 drop-shadow-lg"
                                x-show="activeSlide === {{ $index }}"
                                x-transition:enter="transition ease-out duration-700 delay-300"
                                x-transition:enter-start="opacity-0 translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0">
                                {{ $slider->title }}
                            </h1>
                            @endif
                            
                            @if($slider->subtitle)
                            <p class="text-lg md:text-xl lg:text-2xl text-gray-100 mb-8 opacity-0 leading-relaxed font-light drop-shadow"
                               x-show="activeSlide === {{ $index }}"
                               x-transition:enter="transition ease-out duration-700 delay-500"
                               x-transition:enter-start="opacity-0 translate-y-8"
                               x-transition:enter-end="opacity-100 translate-y-0">
                                {{ $slider->subtitle }}
                            </p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        @if($sliders->count() > 1)
        <button @click="prev()" class="absolute left-4 md:left-6 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition-all focus:outline-none">
            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button @click="next()" class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition-all focus:outline-none">
            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <!-- Indicators -->
        <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-2 md:space-x-3">
            @foreach($sliders as $index => $slider)
            <button @click="goTo({{ $index }})" class="h-2 rounded-full transition-all duration-300 focus:outline-none" :class="activeSlide === {{ $index }} ? 'w-8 bg-blue-500' : 'w-2 bg-white/50 hover:bg-white/80'"></button>
            @endforeach
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('slider', () => ({
            activeSlide: 0,
            slidesCount: {{ $sliders->count() }},
            autoPlayInterval: null,
            init() {
                if (this.slidesCount > 1) {
                    this.startAutoPlay();
                }
            },
            next() {
                this.activeSlide = (this.activeSlide === this.slidesCount - 1) ? 0 : this.activeSlide + 1;
                this.resetAutoPlay();
            },
            prev() {
                this.activeSlide = (this.activeSlide === 0) ? this.slidesCount - 1 : this.activeSlide - 1;
                this.resetAutoPlay();
            },
            goTo(index) {
                this.activeSlide = index;
                this.resetAutoPlay();
            },
            startAutoPlay() {
                this.autoPlayInterval = setInterval(() => {
                    this.activeSlide = (this.activeSlide === this.slidesCount - 1) ? 0 : this.activeSlide + 1;
                }, 5000);
            },
            resetAutoPlay() {
                clearInterval(this.autoPlayInterval);
                this.startAutoPlay();
            }
        }))
    })
</script>
@endpush
@endif

<!-- Welcome Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-blue-50 blur-3xl opacity-70"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 rounded-full bg-indigo-50 blur-3xl opacity-70"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2 space-y-8">
                <div class="inline-block px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-blue-600 font-medium text-sm mb-2">
                    Selamat Datang di {{ config('app.name', 'SchoolCMS') }}
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display text-dark leading-tight">
                    {{ $settings['school_motto'] ?? 'Mendidik Generasi Pemimpin Masa Depan' }}
                </h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Kami berkomitmen untuk memberikan pendidikan berkualitas tinggi yang mengembangkan potensi intelektual, emosional, dan spiritual setiap siswa. Dengan fasilitas modern dan tenaga pendidik profesional, kami siap mengantarkan anak Anda menuju kesuksesan.
                </p>
                <div class="grid grid-cols-2 gap-6 pt-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark text-lg">Kurikulum Merdeka</h4>
                            <p class="text-sm text-gray-500">Berbasis kompetensi</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark text-lg">Pendidikan Karakter</h4>
                            <p class="text-sm text-gray-500">Berbasis nilai-nilai Islami</p>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <a href="/page/profil-sekolah" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                        Pelajari Lebih Lanjut <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            <div class="w-full lg:w-1/2 relative max-w-md mx-auto lg:max-w-none">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 to-indigo-500 transform rotate-3 rounded-3xl opacity-20"></div>
                @if($welcome_image)
                    <img src="{{ Storage::url($welcome_image) }}" alt="School Building" class="relative rounded-3xl shadow-2xl object-cover aspect-[4/3] w-full h-auto border-4 border-white">
                @else
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1000&auto=format&fit=crop" alt="School Building" class="relative rounded-3xl shadow-2xl object-cover aspect-[4/3] w-full h-auto border-4 border-white">
                @endif
                

            </div>
        </div>
    </div>
</section>

<!-- Latest News -->
@if($recent_posts->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold font-display text-dark mb-3">Berita & Artikel Terbaru</h2>
                <p class="text-gray-600">Informasi terkini seputar kegiatan dan perkembangan sekolah.</p>
            </div>
            <a href="/berita" class="hidden md:inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                Lihat Semua Berita <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recent_posts as $post)
            <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group flex flex-col h-full">
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-semibold rounded-full shadow-sm">{{ $post->category->name }}</span>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex items-center text-xs text-gray-500 mb-3 space-x-4">
                        <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $post->created_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="text-xl font-bold font-display text-dark mb-3 leading-snug group-hover:text-blue-600 transition-colors">
                        <a href="/berita/{{ $post->slug }}" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center text-sm font-medium text-blue-600">
                        Baca selengkapnya <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="mt-8 text-center md:hidden">
            <a href="/berita" class="inline-flex items-center justify-center px-6 py-3 border border-blue-600 text-blue-600 rounded-full font-medium w-full hover:bg-blue-50 transition-colors">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>
@endif

<!-- Quick Access Cards -->
<section class="py-12 bg-white relative -mt-8 z-20">
    @php
        $ppdbOpen = ($settings['ppdb_status'] ?? '1') == '1';
    @endphp
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 {{ $ppdbOpen ? 'md:grid-cols-3' : 'md:grid-cols-2 max-w-4xl mx-auto' }} gap-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl p-8 text-white shadow-xl shadow-blue-500/20 transform hover:-translate-y-1 transition-transform">
                <svg class="w-10 h-10 mb-6 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <h3 class="text-2xl font-bold font-display mb-2">Berita & Artikel</h3>
                <p class="text-blue-100 mb-6 line-clamp-2">Tetap update dengan informasi dan kegiatan terbaru dari sekolah kami.</p>
                <a href="/berita" class="inline-flex items-center text-sm font-semibold bg-white/20 hover:bg-white/30 backdrop-blur-sm px-4 py-2 rounded-lg transition-colors">
                    Baca Berita <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
            @if($ppdbOpen)
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl p-8 text-white shadow-xl shadow-indigo-500/20 transform hover:-translate-y-1 transition-transform">
                <svg class="w-10 h-10 mb-6 text-indigo-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <h3 class="text-2xl font-bold font-display mb-2">Info PPDB</h3>
                <p class="text-indigo-100 mb-6 line-clamp-3">Penerimaan Peserta Didik Baru Tahun Ajaran {{ $settings['ppdb_year'] ?? date('Y').'/'.(date('Y')+1) }}.<br><span class="text-sm opacity-80 mt-1 block">{{ $settings['ppdb_date'] ?? 'Januari - Juli '.date('Y') }}</span></p>
                <a href="/ppdb" class="inline-flex items-center text-sm font-semibold bg-white/20 hover:bg-white/30 backdrop-blur-sm px-4 py-2 rounded-lg transition-colors">
                    Daftar Sekarang <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
            @endif
            
            <div class="bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl p-8 text-white shadow-xl shadow-teal-500/20 transform hover:-translate-y-1 transition-transform">
                <svg class="w-10 h-10 mb-6 text-teal-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <h3 class="text-2xl font-bold font-display mb-2">Galeri Kegiatan</h3>
                <p class="text-teal-100 mb-6 line-clamp-2">Lihat berbagai momen seru dan dokumentasi kegiatan belajar mengajar.</p>
                <a href="/galeri" class="inline-flex items-center text-sm font-semibold bg-white/20 hover:bg-white/30 backdrop-blur-sm px-4 py-2 rounded-lg transition-colors">
                    Lihat Galeri <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Achievements Section -->
@if($achievements->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl font-bold font-display text-dark mb-4">Prestasi Gemilang</h2>
            <p class="text-gray-600">Bukti komitmen kami dalam membina dan mengembangkan bakat serta potensi siswa dalam berbagai bidang.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($achievements as $achievement)
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 hover:shadow-lg transition-shadow text-center group">
                <div class="w-20 h-20 rounded-full p-1 bg-white shadow-md mx-auto mb-4 relative z-10">
                    <img src="{{ Storage::url($achievement->image_path) }}" alt="{{ $achievement->title }}" loading="lazy" class="w-full h-full object-cover rounded-full">
                </div>
                <h3 class="font-bold text-dark text-lg mb-1 leading-tight">{{ $achievement->title }}</h3>
                <p class="text-blue-600 font-medium text-sm mb-2">{{ $achievement->level }}</p>
                <p class="text-gray-500 text-sm">{{ $achievement->date->format('Y') }}</p>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="/prestasi" class="inline-flex items-center text-gray-600 font-medium hover:text-blue-600 transition-colors">
                Lihat Seluruh Prestasi <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>
@endif

@endsection
