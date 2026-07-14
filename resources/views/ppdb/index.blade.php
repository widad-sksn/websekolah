@extends('layouts.front')

@section('meta')
<title>Info PPDB - {{ config('app.name', 'SchoolCMS') }}</title>
<meta name="description" content="Informasi Penerimaan Peserta Didik Baru (PPDB) {{ config('app.name', 'SchoolCMS') }}.">
@endsection

@section('content')
<section class="bg-slate-900 text-white py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-600 blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-slate-900 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="inline-block px-4 py-1.5 bg-blue-500/20 text-blue-300 font-medium rounded-full mb-6 border border-blue-500/30">
            Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}
        </div>
        <h1 class="text-4xl md:text-5xl font-bold font-display mb-4">Penerimaan Peserta Didik Baru</h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto">Mari bergabung bersama kami untuk mengukir prestasi dan masa depan yang lebih cerah.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 relative z-20 -mt-12">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Info Section -->
                <div>
                    <h2 class="text-2xl font-bold font-display text-dark mb-6">Informasi Pendaftaran</h2>
                    
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! $settings['ppdb_info_text'] ?? '<div class="flex">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">1</div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-dark mb-1">Persyaratan Dokumen</h4>
                                <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
                                    <li>Fotokopi Ijazah / SKL legalisir (2 lembar)</li>
                                    <li>Fotokopi Akte Kelahiran (2 lembar)</li>
                                    <li>Fotokopi Kartu Keluarga (2 lembar)</li>
                                    <li>Pas foto ukuran 3x4 dan 4x6 (masing-masing 4 lembar)</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="flex mt-6">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">2</div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-dark mb-1">Jalur Pendaftaran</h4>
                                <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
                                    <li>Jalur Prestasi (Akademik & Non-Akademik)</li>
                                    <li>Jalur Reguler / Umum</li>
                                    <li>Jalur Afirmasi</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="flex mt-6">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">3</div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-dark mb-1">Jadwal PPDB</h4>
                                <p class="text-gray-600 text-sm">Pendaftaran dibuka setiap hari kerja pada jam operasional (08.00 - 14.00 WIB) selama kuota masih tersedia.</p>
                            </div>
                        </div>' !!}
                    </div>
                </div>
                
                <!-- Action Section -->
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 flex flex-col justify-center text-center">
                    <svg class="w-16 h-16 mx-auto text-green-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    
                    <h3 class="text-xl font-bold font-display text-dark mb-3">Daftar Via WhatsApp</h3>
                    <p class="text-gray-600 text-sm mb-8">Pendaftaran kini lebih mudah! Hubungi panitia PPDB kami secara langsung melalui WhatsApp untuk informasi dan pendaftaran.</p>
                    
                    @php
                        $waNumber = $settings['ppdb_whatsapp_number'] ?? '6283832286799';
                        $waTextRaw = $settings['ppdb_whatsapp_text'] ?? 'Halo Panitia PPDB ' . config('app.name') . ', saya ingin mendapatkan informasi lebih lanjut mengenai pendaftaran peserta didik baru.';
                        $waText = urlencode($waTextRaw);
                    @endphp
                    
                    <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" target="_blank" class="inline-flex items-center justify-center px-6 py-3.5 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-green-500/30 hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.062 12.025a10.024 10.024 0 012.35-6.495A10.02 10.02 0 0112 2.063c5.523 0 10 4.477 10 10s-4.477 10-10 10a9.97 9.97 0 01-5.006-1.341L2.062 21.94l1.246-4.9A9.97 9.97 0 012.062 12.025zM12 4.062a7.95 7.95 0 00-6.035 2.766 7.952 7.952 0 00-1.865 5.197 7.962 7.962 0 001.077 3.993l-.841 3.307 3.398-.89a7.96 7.96 0 003.774.945c4.417 0 8-3.582 8-8s-3.583-8-8-8zm4.015 10.871c-.22.11-.25.127-.417.152-.167.025-.567-.008-1.075-.246-.508-.238-1.488-.916-2.204-1.742-.716-.826-1.284-1.634-1.325-2.025-.042-.391.075-.684.283-.934.208-.25.467-.25.592-.25.125 0 .25-.008.367 0 .117.008.275-.025.442.342.167.367.575 1.408.625 1.508.05.1.1.233.025.4-.075.167-.133.267-.242.392-.108.125-.233.267-.325.375-.1.108-.2.225-.083.417.117.192.517.842 1.108 1.367.767.683 1.425.9 1.625 1.008.2.108.317.092.442-.042.125-.133.542-.625.692-.842.15-.217.292-.175.475-.108.183.067 1.158.542 1.358.642.2.1.333.15.383.233.05.083.05.517-.167 1.142z" clip-rule="evenodd" /></svg>
                        Hubungi via WhatsApp
                    </a>
                    
                    <p class="text-xs text-gray-500 mt-4">Pesan Anda akan langsung terhubung dengan Panitia PPDB.</p>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection
