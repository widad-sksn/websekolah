@extends('layouts.front')

@section('meta')
<title>{{ $page->meta_title ?? $page->title . ' - ' . config('app.name', 'SchoolCMS') }}</title>
<meta name="description" content="{{ $page->meta_description ?? Str::limit(strip_tags($page->content), 150) }}">
<!-- Open Graph -->
<meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
<meta property="og:description" content="{{ $page->meta_description ?? Str::limit(strip_tags($page->content), 150) }}">
<meta property="og:type" content="article">
@endsection

@section('content')

<!-- Header Section -->
<section class="bg-slate-900 text-white py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-600 blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-slate-900 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold font-display mb-4">{{ $page->title }}</h1>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <article class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12 prose prose-lg prose-blue max-w-none text-gray-700">
            {!! $page->content !!}
        </article>
    </div>
</section>

@endsection
