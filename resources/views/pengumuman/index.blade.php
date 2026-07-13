@extends('layouts.front')

@section('meta')
<title>Pengumuman - {{ config('app.name', 'SchoolCMS') }}</title>
<meta name="description" content="Papan pengumuman resmi dari {{ config('app.name', 'SchoolCMS') }}.">
@endsection

@section('content')
<section class="bg-slate-900 text-white py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-indigo-600 blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-slate-900 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold font-display mb-4">Pengumuman</h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto">Informasi dan pemberitahuan penting dari sekolah.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="space-y-6">
            @forelse($announcements as $announcement)
            <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start">
                <div class="flex-shrink-0 w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex flex-col items-center justify-center border border-indigo-100">
                    <span class="text-xs font-semibold">{{ $announcement->created_at->format('M') }}</span>
                    <span class="text-2xl font-bold">{{ $announcement->created_at->format('d') }}</span>
                </div>
                <div class="flex-grow">
                    <h3 class="text-xl font-bold font-display text-dark mb-3">{{ $announcement->title }}</h3>
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! $announcement->content !!}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <p class="text-gray-500 text-lg font-medium">Belum ada pengumuman.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12">
            {{ $announcements->links() }}
        </div>
    </div>
</section>
@endsection
