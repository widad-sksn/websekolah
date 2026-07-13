<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @hasSection('meta')
        @yield('meta')
    @else
        <title>{{ config('app.name', 'SchoolCMS') }}</title>
        <meta name="description" content="Website Resmi {{ config('app.name', 'SchoolCMS') }}">
    @endif

    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|plus-jakarta-sans:500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    
    

    <!-- Navigation -->
    <header class="glass-nav sticky top-0 z-50 transition-all duration-300 shadow-sm" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-14 md:h-[68px] lg:h-[72px]">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3">
                    @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'SchoolCMS') }}" class="h-9 md:h-10 lg:h-[44px] w-auto">
                    @else
                        <div class="w-9 h-9 md:w-10 md:h-10 lg:w-11 lg:h-11 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-lg lg:text-xl font-display shadow-lg shadow-blue-500/30">
                            {{ substr(config('app.name', 'SchoolCMS'), 0, 1) }}
                        </div>
                    @endif
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center space-x-8 font-medium text-sm">
                    <a href="/" class="text-dark hover:text-primary transition-colors {{ request()->is('/') ? 'text-primary' : '' }}">Beranda</a>
                    
                    <!-- Profil Dropdown -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center text-dark hover:text-primary transition-colors focus:outline-none">
                            Profil <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-transition.opacity class="absolute top-full left-0 pt-2 w-48" style="display: none;">
                            <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden py-1">
                                <a href="/page/profil-sekolah" class="block px-4 py-2 hover:bg-gray-50 hover:text-primary transition-colors">Profil Sekolah</a>
                                <a href="/page/sejarah-sekolah" class="block px-4 py-2 hover:bg-gray-50 hover:text-primary transition-colors">Sejarah</a>
                                <a href="/page/visi-misi" class="block px-4 py-2 hover:bg-gray-50 hover:text-primary transition-colors">Visi & Misi</a>
                                <a href="/guru" class="block px-4 py-2 hover:bg-gray-50 hover:text-primary transition-colors">Direktori Guru</a>
                            </div>
                        </div>
                    </div>

                    <a href="/berita" class="text-dark hover:text-primary transition-colors {{ request()->is('berita*') ? 'text-primary' : '' }}">Berita</a>
                    <a href="/galeri" class="text-dark hover:text-primary transition-colors {{ request()->is('galeri*') ? 'text-primary' : '' }}">Galeri</a>
                    <a href="/prestasi" class="text-dark hover:text-primary transition-colors {{ request()->is('prestasi*') ? 'text-primary' : '' }}">Prestasi</a>
                    <a href="/pengumuman" class="text-dark hover:text-primary transition-colors {{ request()->is('pengumuman*') ? 'text-primary' : '' }}">Pengumuman</a>
                    <a href="/download" class="text-dark hover:text-primary transition-colors {{ request()->is('download*') ? 'text-primary' : '' }}">Download</a>
                </nav>

                <!-- CTA Button -->
                @if(($settings['ppdb_status'] ?? '1') == '1')
                <div class="hidden lg:block">
                    <a href="/ppdb" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-full font-medium text-sm transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transform hover:-translate-y-0.5">
                        Info PPDB
                    </a>
                </div>
                @endif

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden flex items-center space-x-1.5 text-dark font-medium focus:outline-none py-2 px-3 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    <span class="text-sm">Menu</span>
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenuOpen" class="w-5 h-5" style="display:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition.opacity class="lg:hidden bg-white border-t border-border shadow-xl absolute w-full" style="display: none;">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="/" class="block px-3 py-3 rounded-lg text-base font-medium {{ request()->is('/') ? 'bg-blue-50 text-primary' : 'text-dark hover:bg-gray-50' }}">Beranda</a>
                <a href="/page/profil-sekolah" class="block px-3 py-3 rounded-lg text-base font-medium text-dark hover:bg-gray-50">Profil Sekolah</a>
                <a href="/page/sejarah-sekolah" class="block px-3 py-3 rounded-lg text-base font-medium text-dark hover:bg-gray-50">Sejarah</a>
                <a href="/page/visi-misi" class="block px-3 py-3 rounded-lg text-base font-medium text-dark hover:bg-gray-50">Visi & Misi</a>
                <a href="/guru" class="block px-3 py-3 rounded-lg text-base font-medium {{ request()->is('guru*') ? 'bg-blue-50 text-primary' : 'text-dark hover:bg-gray-50' }}">Direktori Guru</a>
                <a href="/berita" class="block px-3 py-3 rounded-lg text-base font-medium {{ request()->is('berita*') ? 'bg-blue-50 text-primary' : 'text-dark hover:bg-gray-50' }}">Berita</a>
                <a href="/galeri" class="block px-3 py-3 rounded-lg text-base font-medium {{ request()->is('galeri*') ? 'bg-blue-50 text-primary' : 'text-dark hover:bg-gray-50' }}">Galeri</a>
                <a href="/prestasi" class="block px-3 py-3 rounded-lg text-base font-medium {{ request()->is('prestasi*') ? 'bg-blue-50 text-primary' : 'text-dark hover:bg-gray-50' }}">Prestasi</a>
                <a href="/pengumuman" class="block px-3 py-3 rounded-lg text-base font-medium {{ request()->is('pengumuman*') ? 'bg-blue-50 text-primary' : 'text-dark hover:bg-gray-50' }}">Pengumuman</a>
                <a href="/download" class="block px-3 py-3 rounded-lg text-base font-medium {{ request()->is('download*') ? 'bg-blue-50 text-primary' : 'text-dark hover:bg-gray-50' }}">Download</a>
                
                @if(($settings['ppdb_status'] ?? '1') == '1')
                <div class="pt-4 pb-2">
                    <a href="/ppdb" class="block w-full text-center px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-medium shadow-md">Info PPDB</a>
                </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                
                <!-- Brand -->
                <div class="space-y-4">
                    <a href="/" class="flex items-center space-x-3 text-white mb-6 hover:text-blue-200 transition-colors">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'SchoolCMS') }}" class="h-10 w-auto">
                        @else
                            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center font-bold text-xl font-display">
                                {{ substr(config('app.name', 'SchoolCMS'), 0, 1) }}
                            </div>
                        @endif
                        <span class="font-display font-semibold text-lg tracking-wide">MTsM 32 Sumberagung</span>
                    </a>
                    <p class="text-sm leading-relaxed">Membangun generasi unggul, berprestasi, dan berakhlak mulia untuk masa depan yang lebih baik.</p>
                    <div class="flex space-x-4 pt-2">
                        <a href="https://www.facebook.com/share/1EyD6G3ig1/" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd"></path></svg></a>
                    </div>
                </div>

            <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-semibold text-lg mb-6 font-display">Tautan Cepat</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="/page/profil" class="hover:text-white transition-colors flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2"></span> Profil Sekolah</a></li>
                        <li><a href="/berita" class="hover:text-white transition-colors flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2"></span> Berita Terbaru</a></li>
                        <li><a href="/galeri" class="hover:text-white transition-colors flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2"></span> Galeri Kegiatan</a></li>
                        <li><a href="/pengumuman" class="hover:text-white transition-colors flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2"></span> Pengumuman</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-white font-semibold text-lg mb-6 font-display">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>MTsS Muhammadiyah 32, Sumberagung, Kec. Brondong, Kab. Lamongan, Jawa Timur</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>(0322) 1234567</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>mtstigadua@gmail.com</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Maps -->
                <div>
                    <h3 class="text-white font-semibold text-lg mb-6 font-display">Lokasi</h3>
                    <div class="h-48 bg-slate-800 rounded-xl overflow-hidden relative group border border-slate-700">
                        <iframe 
                            src="https://maps.google.com/maps?q=-6.8934986,112.2945565%20(Perguruan%20Muhammadiyah%20Sumberagung)&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="absolute inset-0 transition-all duration-500">
                        </iframe>
                    </div>
                </div>

            </div>

            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs">
                <p>{{ $settings['footer_text'] ?? '&copy; ' . date('Y') . ' ' . config('app.name', 'SchoolCMS') . '. All rights reserved.' }}</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <p>Website created by alumni <a href="https://github.com/widad-sksn" target="_blank" rel="noopener noreferrer" class="font-semibold text-blue-400 hover:text-blue-300 transition-colors">widad-sksn</a></p>
                </div>
            </div>
        </div>
    </footer>
    
    @stack('scripts')
</body>
</html>
