@extends('layouts.front')

@section('meta')
<title>{{ $post->title }} - {{ config('app.name', 'SchoolCMS') }}</title>
<meta name="description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
<!-- Open Graph -->
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
<meta property="og:image" content="{{ asset('storage/' . $post->thumbnail) }}">
<meta property="og:type" content="article">
@endsection

@section('content')

<!-- Article Header Section -->
<section class="bg-slate-900 pt-20 pb-24 md:pt-24 md:pb-32 relative overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-slate-900/80 z-10"></div>
        <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-20 blur-sm">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-slate-900/40"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 max-w-4xl text-center">
        <a href="/berita?kategori={{ $post->category->slug }}" class="inline-block px-3 py-1 md:px-4 md:py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs md:text-sm font-semibold rounded-full shadow-lg transition-colors mb-4 md:mb-6">
            {{ $post->category->name }}
        </a>
        <h1 class="text-2xl md:text-5xl font-bold font-display text-white leading-tight mb-4 md:mb-6">{{ $post->title }}</h1>
        <div class="flex flex-wrap items-center justify-center text-xs md:text-sm text-slate-300 gap-3 md:gap-6">
            <span class="flex items-center"><svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Admin</span>
            <span class="flex items-center"><svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $post->created_at->format('d M Y') }}</span>
            <span class="flex items-center"><svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> {{ $post->views }}x Dilihat</span>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="pb-12 md:pb-20 relative -mt-16 md:-mt-24 z-20">
    <div class="container mx-auto px-4">
        
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Main Content -->
            <div class="lg:w-3/4">
                <article class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                        <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full object-cover">
                    </div> 
                    
                    <div class="p-6 md:p-12 prose prose-base md:prose-lg prose-blue max-w-none text-gray-700">
                        {!! $post->content !!}
                    </div>
                    
                    <!-- Share & Tags -->
                    <div class="px-8 md:px-12 py-6 bg-gray-50 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-semibold text-gray-700">Bagikan:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.062 12.025a10.024 10.024 0 012.35-6.495A10.02 10.02 0 0112 2.063c5.523 0 10 4.477 10 10s-4.477 10-10 10a9.97 9.97 0 01-5.006-1.341L2.062 21.94l1.246-4.9A9.97 9.97 0 012.062 12.025zM12 4.062a7.95 7.95 0 00-6.035 2.766 7.952 7.952 0 00-1.865 5.197 7.962 7.962 0 001.077 3.993l-.841 3.307 3.398-.89a7.96 7.96 0 003.774.945c4.417 0 8-3.582 8-8s-3.583-8-8-8zm4.015 10.871c-.22.11-.25.127-.417.152-.167.025-.567-.008-1.075-.246-.508-.238-1.488-.916-2.204-1.742-.716-.826-1.284-1.634-1.325-2.025-.042-.391.075-.684.283-.934.208-.25.467-.25.592-.25.125 0 .25-.008.367 0 .117.008.275-.025.442.342.167.367.575 1.408.625 1.508.05.1.1.233.025.4-.075.167-.133.267-.242.392-.108.125-.233.267-.325.375-.1.108-.2.225-.083.417.117.192.517.842 1.108 1.367.767.683 1.425.9 1.625 1.008.2.108.317.092.442-.042.125-.133.542-.625.692-.842.15-.217.292-.175.475-.108.183.067 1.158.542 1.358.642.2.1.333.15.383.233.05.083.05.517-.167 1.142z" clip-rule="evenodd" /></svg>
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4 space-y-8">
                <!-- Recent Posts Widget -->
                @if($recent_posts->count() > 0)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold font-display text-dark mb-6">Berita Terkait</h3>
                    <div class="space-y-6">
                        @foreach($recent_posts as $recent)
                        <div class="flex gap-4 group">
                            <a href="/berita/{{ $recent->slug }}" class="w-20 h-20 flex-shrink-0 rounded-xl overflow-hidden">
                                <img src="{{ Storage::url($recent->thumbnail) }}" alt="{{ $recent->title }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                            </a>
                            <div>
                                <h4 class="font-bold text-sm text-dark leading-tight group-hover:text-blue-600 transition-colors">
                                    <a href="/berita/{{ $recent->slug }}">{{ Str::limit($recent->title, 45) }}</a>
                                </h4>
                                <p class="text-xs text-gray-500 mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $recent->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- CTA Widget -->
                <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl p-6 text-white text-center shadow-lg shadow-blue-500/20">
                    <h3 class="text-xl font-bold font-display mb-2">Informasi PPDB</h3>
                    <p class="text-blue-100 text-sm mb-6">Pendaftaran peserta didik baru telah dibuka. Segera daftarkan putra-putri Anda.</p>
                    <a href="/ppdb" class="inline-flex items-center justify-center px-6 py-2.5 bg-white text-blue-600 hover:bg-gray-50 rounded-full font-bold text-sm transition-colors w-full">
                        Daftar Sekarang
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
