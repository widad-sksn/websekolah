@extends('layouts.front')

@section('meta')
<title>Prestasi - {{ config('app.name', 'SchoolCMS') }}</title>
<meta name="description" content="Kumpulan prestasi siswa dan sekolah di {{ config('app.name', 'SchoolCMS') }}.">
@endsection

@section('content')
<section class="bg-slate-900 text-white py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-600 blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-slate-900 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold font-display mb-4">Prestasi Gemilang</h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto">Membanggakan! Berikut adalah pencapaian luar biasa dari siswa-siswi dan sekolah kami.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($achievements as $achievement)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl transition-all">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ Storage::url($achievement->photo) }}" alt="{{ $achievement->title }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full shadow-sm">
                            {{ $achievement->level }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold font-display text-dark mb-2">{{ $achievement->title }}</h3>
                    @if($achievement->description)
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($achievement->description, 80) }}</p>
                    @endif
                    <div class="flex items-center text-sm font-medium text-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Tahun {{ $achievement->date->format('Y') }}
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada data prestasi.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12">
            {{ $achievements->links() }}
        </div>
    </div>
</section>
@endsection
