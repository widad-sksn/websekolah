@extends('layouts.front')

@section('meta')
<title>Direktori Guru - {{ config('app.name', 'SchoolCMS') }}</title>
<meta name="description" content="Profil dan data tenaga pendidik di {{ config('app.name', 'SchoolCMS') }}.">
@endsection

@section('content')
<section class="bg-slate-900 text-white py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-600 blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-slate-900 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold font-display mb-4">Direktori Guru</h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto">Mengenal lebih dekat para tenaga pendidik profesional yang berdedikasi tinggi.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($teachers as $teacher)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl transition-shadow text-center p-6">
                <div class="w-32 h-32 mx-auto rounded-full p-2 bg-gray-50 border border-gray-100 mb-6 transform group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ Storage::url($teacher->photo_path) }}" alt="{{ $teacher->name }}" loading="lazy" class="w-full h-full object-cover rounded-full">
                </div>
                <h3 class="text-lg font-bold font-display text-dark mb-1">{{ $teacher->name }}</h3>
                <p class="text-blue-600 font-medium text-sm mb-2">{{ $teacher->position }}</p>
                <div class="text-sm text-gray-500 mb-4">
                    NIP: {{ $teacher->nip ?? '-' }}
                </div>
                <div class="flex justify-center space-x-3 text-gray-400">
                    <!-- Social icons could go here -->
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada data guru.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12">
            {{ $teachers->links() }}
        </div>
    </div>
</section>
@endsection
