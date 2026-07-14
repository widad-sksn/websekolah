@extends('layouts.front')

@section('content')

<!-- Hero Slider Section -->
@if($sliders->count() > 0)
<div class="container mx-auto px-4 mt-4 md:mt-8 mb-4 md:mb-8">
    <div class="relative w-full aspect-[12/5] overflow-hidden bg-transparent group rounded-xl md:rounded-2xl" x-data="slider()">
        <!-- Slides -->
        <div class="relative h-full">
            @foreach($sliders as $index => $slider)
            <div x-show="activeSlide === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-[1500ms]" 
                 x-transition:enter-start="opacity-0 scale-105" 
                 x-transition:enter-end="opacity-100 scale-100" 
                 x-transition:leave="transition ease-in-out duration-[1500ms]" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="absolute inset-0"
                 style="display: none;">
                
                <img src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}" class="absolute inset-0 w-full h-full object-cover">
                
                <!-- Overlay background for text readability -->
                <div class="absolute inset-0 bg-black/40"></div>
                
                <!-- Content (Hidden on mobile, Centered on desktop) -->
                <div class="absolute inset-0 hidden md:flex items-center justify-center text-center">
                    <div class="container mx-auto px-8 md:px-16">
                        <div class="max-w-4xl mx-auto">
                            @if($slider->title)
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display text-white leading-tight mb-4 opacity-0 drop-shadow-2xl"
                                x-show="activeSlide === {{ $index }}"
                                x-transition:enter="transition ease-out duration-[2000ms] delay-[500ms]"
                                x-transition:enter-start="opacity-0 translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-[1500ms]"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-4">
                                {{ $slider->title }}
                            </h1>
                            @endif
                            
                            @if($slider->subtitle)
                            <p class="text-lg md:text-xl lg:text-2xl text-gray-100 mb-8 opacity-0 leading-relaxed font-light drop-shadow"
                               x-show="activeSlide === {{ $index }}"
                               x-transition:enter="transition ease-out duration-[2000ms] delay-[1000ms]"
                               x-transition:enter-start="opacity-0 translate-y-8"
                               x-transition:enter-end="opacity-100 translate-y-0"
                               x-transition:leave="transition ease-in duration-[1500ms] delay-[200ms]"
                               x-transition:leave-start="opacity-100 translate-y-0"
                               x-transition:leave-end="opacity-0 -translate-y-4">
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
        <button @click="prev()" class="absolute left-3 md:left-6 top-1/2 -translate-y-1/2 w-8 h-8 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition-all focus:outline-none">
            <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button @click="next()" class="absolute right-3 md:right-6 top-1/2 -translate-y-1/2 w-8 h-8 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition-all focus:outline-none">
            <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <!-- Indicators -->
        <div class="absolute bottom-3 md:bottom-6 left-0 right-0 flex justify-center space-x-1.5 md:space-x-3">
            @foreach($sliders as $index => $slider)
            <button @click="goTo({{ $index }})" class="rounded-full transition-all duration-300 focus:outline-none h-1.5 md:h-2" :class="activeSlide === {{ $index }} ? 'w-4 md:w-8 bg-blue-500' : 'w-1.5 md:w-2 bg-white/50 hover:bg-white/80'"></button>
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
                }, 10000);
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
<section class="bg-white relative overflow-hidden py-12 lg:py-24">
    <div class="container mx-auto px-4 max-w-[1280px]">
        <div class="flex flex-col lg:flex-row items-center gap-[48px] lg:gap-[80px]">
            
            <!-- Left Side (Text) -->
            <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left mt-[40px] lg:mt-0 animate-fade-up">
                
                <style>
                @keyframes fadeUpHero {
                    from { opacity: 0; transform: translateY(30px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                .animate-fade-up {
                    animation: fadeUpHero 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                }
                </style>

                <!-- Eyebrow -->
                <span class="text-[14px] lg:text-[15px] font-semibold text-[#2563EB] uppercase tracking-[0.08em] mb-[10px]">
                    Selamat Datang di
                </span>
                
                <!-- School Name -->
                <h3 class="text-[24px] lg:text-[34px] font-bold text-[#0F172A] mb-[18px]">
                    MTs Muhammadiyah 32 Sumberagung
                </h3>
                
                <!-- Main Headline -->
                <h1 class="text-[32px] lg:text-[42px] font-extrabold text-[#0F172A] leading-[1.1] mb-[24px]">
                    Mendidik Generasi<br>Berakhlak Mulia &<br>Berprestasi
                </h1>
                
                <!-- Description -->
                <p class="text-[16px] lg:text-[18px] text-[#475569] leading-[1.8] max-w-[650px] mx-auto lg:mx-0 mb-[28px]">
                    Kami berkomitmen memberikan pendidikan berkualitas tinggi yang mengembangkan potensi intelektual, emosional, dan spiritual setiap siswa.
                </p>
                
                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start w-full sm:w-auto">
                    <a href="/page/profil-sekolah" class="inline-flex justify-center items-center px-8 py-3.5 bg-[#2563EB] text-white font-semibold rounded-[100px] hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 shadow-[0_4px_14px_0_rgba(37,99,235,0.39)]">
                        Profil Sekolah
                    </a>
                    <a href="/ppdb" class="inline-flex justify-center items-center px-8 py-3.5 bg-white text-[#0F172A] font-semibold rounded-[100px] border border-gray-200 hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300">
                        PPDB
                    </a>
                </div>
                
            </div>

            <!-- Right Side (Image) -->
            <div class="w-full lg:w-1/2">
                <div class="relative w-full rounded-[24px] overflow-hidden shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] animate-fade-up" style="animation-delay: 0.2s;">
                    @if(isset($welcome_image) && $welcome_image)
                        <img src="{{ Storage::url($welcome_image) }}" alt="School Building" class="object-cover w-full h-auto aspect-[4/3] hover:scale-105 transition-transform duration-700 ease-in-out">
                    @else
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1000&auto=format&fit=crop" alt="School Building" class="object-cover w-full h-auto aspect-[4/3] hover:scale-105 transition-transform duration-700 ease-in-out">
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Latest News -->
@if($recent_posts->count() > 0)
<section class="py-12 md:py-16 bg-gray-50">
    <div class="container mx-auto px-4" x-data="newsSlider()" x-init="start()">
        <div class="flex justify-between items-end mb-8 md:mb-12">
            <div class="text-left w-2/3 pr-4">
                <h2 class="text-2xl md:text-3xl font-bold font-display text-dark mb-2 md:mb-3">Berita & Artikel</h2>
                <p class="text-sm md:text-base text-gray-600 line-clamp-2 md:line-clamp-none">Informasi terkini seputar kegiatan dan perkembangan sekolah.</p>
            </div>
            <div class="flex space-x-2 md:space-x-3 pb-1">
                <button @click="prev()" class="w-9 h-9 md:w-11 md:h-11 rounded-full border border-gray-200 bg-white shadow-sm flex items-center justify-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors focus:outline-none">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="next()" class="w-9 h-9 md:w-11 md:h-11 rounded-full border border-gray-200 bg-white shadow-sm flex items-center justify-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors focus:outline-none">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        <div class="relative overflow-hidden w-full py-4 mt-2">
            <div class="flex transition-transform duration-500 ease-in-out -mx-2 md:-mx-4" :style="'transform: translateX(-' + (currentSlide * (100 / itemsPerSlide)) + '%)'">
                @foreach($recent_posts as $post)
                <div class="w-full md:w-1/2 lg:w-1/4 flex-shrink-0 px-2 md:px-4">
                    <a href="/berita/{{ $post->slug }}" class="relative block h-[20rem] md:h-auto md:aspect-square rounded-2xl overflow-hidden group cursor-pointer shadow-sm hover:shadow-xl transition-all">
                        <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-transparent"></div>
                        
                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 left-0 w-full p-4 md:p-6 text-left">
                            <div class="inline-flex items-center justify-center px-2.5 py-1 md:px-3 md:py-1 bg-white/20 backdrop-blur-md border border-white/30 rounded-lg mb-2 md:mb-3">
                                <span class="text-white text-[10px] md:text-xs font-bold uppercase tracking-wider leading-none pt-0.5">{{ $post->category->name }}</span>
                            </div>
                            <h3 class="font-bold text-white text-lg md:text-xl mb-1.5 md:mb-2 leading-tight group-hover:text-blue-300 transition-colors">{{ Str::limit($post->title, 50) }}</h3>
                            <p class="text-slate-300 text-xs md:text-sm line-clamp-2 mb-3">
                                {{ Str::limit(strip_tags($post->content), 80) }}
                            </p>
                            <div class="text-blue-300 text-[10px] md:text-xs font-medium flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $post->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            
        </div>

        <script>
        function newsSlider() {
            return {
                currentSlide: 0,
                totalItems: {{ $recent_posts->count() }},
                itemsPerSlide: 4,
                interval: null,
                init() {
                    this.updateItemsPerSlide();
                    window.addEventListener('resize', () => this.updateItemsPerSlide());
                },
                updateItemsPerSlide() {
                    if (window.innerWidth < 768) this.itemsPerSlide = 1;
                    else if (window.innerWidth < 1024) this.itemsPerSlide = 2;
                    else this.itemsPerSlide = 4;
                    
                    if (this.currentSlide > Math.max(0, this.totalItems - this.itemsPerSlide)) {
                        this.currentSlide = Math.max(0, this.totalItems - this.itemsPerSlide);
                    }
                },
                start() {
                    this.init();
                    if(this.totalItems > this.itemsPerSlide) {
                        this.interval = setInterval(() => {
                            this.next();
                        }, 5000);
                    }
                },
                next() {
                    if (this.currentSlide >= Math.max(0, this.totalItems - this.itemsPerSlide)) {
                        this.currentSlide = 0;
                    } else {
                        this.currentSlide++;
                    }
                },
                prev() {
                    if (this.currentSlide <= 0) {
                        this.currentSlide = Math.max(0, this.totalItems - this.itemsPerSlide);
                    } else {
                        this.currentSlide--;
                    }
                }
            }
        }
        </script>
        
        <div class="mt-6 md:mt-8 text-center flex flex-col md:flex-row justify-center items-center gap-4">
            <a href="/berita" class="inline-flex items-center justify-center px-6 py-3 border border-blue-600 text-blue-600 rounded-xl font-bold text-sm hover:bg-blue-600 hover:text-white transition-colors shadow-sm">
                Lihat Semua Berita <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>
@endif



<!-- Achievements Section -->
@if($achievements->count() > 0)
<section class="py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4" x-data="achievementSlider()" x-init="start()">
        <div class="flex justify-between items-end mb-8 md:mb-12">
            <div class="text-left w-2/3 pr-4 max-w-2xl">
                <h2 class="text-2xl md:text-3xl font-bold font-display text-dark mb-2 md:mb-4">Prestasi Gemilang</h2>
                <p class="text-sm md:text-base text-gray-600 line-clamp-2 md:line-clamp-none">Bukti komitmen kami dalam membina dan mengembangkan bakat serta potensi siswa dalam berbagai bidang.</p>
            </div>
            <div class="flex space-x-2 md:space-x-3 pb-1">
                <button @click="prev()" class="w-9 h-9 md:w-11 md:h-11 rounded-full border border-gray-200 bg-white shadow-sm flex items-center justify-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors focus:outline-none">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="next()" class="w-9 h-9 md:w-11 md:h-11 rounded-full border border-gray-200 bg-white shadow-sm flex items-center justify-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors focus:outline-none">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
        
        <div class="relative overflow-hidden w-full py-4 mt-2">
            <div class="flex transition-transform duration-500 ease-in-out -mx-2 md:-mx-4" :style="'transform: translateX(-' + (currentSlide * (100 / itemsPerSlide)) + '%)'">
                @foreach($achievements as $achievement)
                <div class="w-full sm:w-1/2 lg:w-1/4 flex-shrink-0 px-2 md:px-4">
                    <a href="/prestasi/{{ $achievement->id }}" class="relative block h-[20rem] md:h-auto md:aspect-square rounded-2xl overflow-hidden group cursor-pointer shadow-sm hover:shadow-xl transition-all">
                        <img src="{{ Storage::url($achievement->photo) }}" alt="{{ $achievement->title }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-transparent"></div>
                        
                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 left-0 w-full p-4 md:p-6 text-left">
                            <div class="inline-flex items-center justify-center px-2.5 py-1 md:px-3 md:py-1 bg-white/20 backdrop-blur-md border border-white/30 rounded-lg mb-2 md:mb-3">
                                <span class="text-white text-[10px] md:text-xs font-bold uppercase tracking-wider leading-none pt-0.5">{{ $achievement->level }}</span>
                            </div>
                            <h3 class="font-bold text-white text-lg md:text-xl mb-1 md:mb-1.5 leading-tight group-hover:text-blue-300 transition-colors">{{ $achievement->title }}</h3>
                            <p class="text-slate-300 text-xs md:text-sm flex items-center">
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Tahun {{ $achievement->year }}
                            </p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            
        </div>
        
        <script>
        function achievementSlider() {
            return {
                currentSlide: 0,
                totalItems: {{ $achievements->count() }},
                itemsPerSlide: 4,
                interval: null,
                init() {
                    this.updateItemsPerSlide();
                    window.addEventListener('resize', () => this.updateItemsPerSlide());
                },
                updateItemsPerSlide() {
                    if (window.innerWidth < 640) this.itemsPerSlide = 1;
                    else if (window.innerWidth < 1024) this.itemsPerSlide = 2;
                    else this.itemsPerSlide = 4;
                    
                    if (this.currentSlide > Math.max(0, this.totalItems - this.itemsPerSlide)) {
                        this.currentSlide = Math.max(0, this.totalItems - this.itemsPerSlide);
                    }
                },
                start() {
                    this.init();
                    if(this.totalItems > this.itemsPerSlide) {
                        this.interval = setInterval(() => {
                            this.next();
                        }, 5000);
                    }
                },
                next() {
                    if (this.currentSlide >= Math.max(0, this.totalItems - this.itemsPerSlide)) {
                        this.currentSlide = 0;
                    } else {
                        this.currentSlide++;
                    }
                },
                prev() {
                    if (this.currentSlide <= 0) {
                        this.currentSlide = Math.max(0, this.totalItems - this.itemsPerSlide);
                    } else {
                        this.currentSlide--;
                    }
                }
            }
        }
        </script>

        <div class="mt-6 md:mt-8 text-center flex flex-col md:flex-row justify-center items-center gap-4">
            <a href="/prestasi" class="inline-flex items-center justify-center px-6 py-3 border border-blue-600 text-blue-600 rounded-xl font-bold text-sm hover:bg-blue-600 hover:text-white transition-colors shadow-sm">
                Lihat Semua Prestasi <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Quick Access Cards (Moved below Prestasi, smaller) -->
<section class="py-8 md:py-12 bg-gray-50">
    @php
        $ppdbOpen = ($settings['ppdb_status'] ?? '1') == '1';
    @endphp
    <div class="container mx-auto px-4">
        <div class="grid {{ $ppdbOpen ? 'grid-cols-3' : 'grid-cols-2 max-w-4xl mx-auto' }} gap-2 md:gap-6">
            <a href="/berita" class="block bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl md:rounded-2xl p-2 md:p-6 text-white shadow-lg shadow-blue-500/20 transform hover:-translate-y-1 transition-transform text-center md:text-left aspect-square md:aspect-auto flex flex-col justify-center items-center md:block">
                <svg class="w-5 h-5 md:w-8 md:h-8 mb-1 md:mb-4 mx-auto md:mx-0 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <h3 class="text-xs md:text-xl font-bold font-display mb-0 md:mb-2 leading-tight">Berita<span class="hidden md:inline"> & Artikel</span></h3>
                <p class="hidden md:block text-blue-100 text-sm mb-4 line-clamp-2">Tetap update dengan informasi dan kegiatan terbaru dari sekolah kami.</p>
                <div class="hidden md:inline-flex items-center text-sm font-semibold bg-white/20 hover:bg-white/30 backdrop-blur-sm px-4 py-2 rounded-lg transition-colors">
                    Baca Berita <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>
            @if($ppdbOpen)
            <a href="/ppdb" class="block bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl md:rounded-2xl p-2 md:p-6 text-white shadow-lg shadow-indigo-500/20 transform hover:-translate-y-1 transition-transform text-center md:text-left aspect-square md:aspect-auto flex flex-col justify-center items-center md:block">
                <svg class="w-5 h-5 md:w-8 md:h-8 mb-1 md:mb-4 mx-auto md:mx-0 text-indigo-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <h3 class="text-xs md:text-xl font-bold font-display mb-0 md:mb-2 leading-tight">PPDB<span class="hidden md:inline"> Online</span></h3>
                <p class="hidden md:block text-indigo-100 text-sm mb-4 line-clamp-3">Penerimaan Peserta Didik Baru Tahun Ajaran {{ $settings['ppdb_year'] ?? date('Y').'/'.(date('Y')+1) }}.<br><span class="text-xs opacity-80 mt-1 block">{{ $settings['ppdb_date'] ?? 'Januari - Juli '.date('Y') }}</span></p>
                <div class="hidden md:inline-flex items-center text-sm font-semibold bg-white/20 hover:bg-white/30 backdrop-blur-sm px-4 py-2 rounded-lg transition-colors">
                    Daftar Sekarang <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>
            @endif
            
            <a href="/galeri" class="block bg-gradient-to-br from-teal-500 to-teal-700 rounded-xl md:rounded-2xl p-2 md:p-6 text-white shadow-lg shadow-teal-500/20 transform hover:-translate-y-1 transition-transform text-center md:text-left aspect-square md:aspect-auto flex flex-col justify-center items-center md:block">
                <svg class="w-5 h-5 md:w-8 md:h-8 mb-1 md:mb-4 mx-auto md:mx-0 text-teal-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <h3 class="text-xs md:text-xl font-bold font-display mb-0 md:mb-2 leading-tight">Galeri<span class="hidden md:inline"> Kegiatan</span></h3>
                <p class="hidden md:block text-teal-100 text-sm mb-4 line-clamp-2">Lihat berbagai momen seru dan dokumentasi kegiatan belajar mengajar.</p>
                <div class="hidden md:inline-flex items-center text-sm font-semibold bg-white/20 hover:bg-white/30 backdrop-blur-sm px-4 py-2 rounded-lg transition-colors">
                    Lihat Galeri <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>
        </div>
    </div>
</section>

@endsection
