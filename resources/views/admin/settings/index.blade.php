@extends('layouts.admin')

@section('header', 'Pengaturan Website')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-border">
    <div class="px-6 py-4 border-b border-border">
        <h2 class="text-lg font-bold text-dark font-display">Konfigurasi Utama</h2>
        <p class="text-sm text-muted">Atur identitas, kontak, sosial media, dan preferensi warna website.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf

        <div x-data="{ tab: 'identitas' }">
            
            <!-- Tabs -->
            <div class="flex space-x-4 border-b border-border mb-6 overflow-x-auto">
                <button type="button" @click="tab = 'identitas'" :class="tab === 'identitas' ? 'border-primary text-primary' : 'border-transparent text-muted hover:text-dark hover:border-gray-300'" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                    Identitas Sekolah
                </button>
                <button type="button" @click="tab = 'kontak'" :class="tab === 'kontak' ? 'border-primary text-primary' : 'border-transparent text-muted hover:text-dark hover:border-gray-300'" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                    Kontak & Sosmed
                </button>
                <button type="button" @click="tab = 'tampilan'" :class="tab === 'tampilan' ? 'border-primary text-primary' : 'border-transparent text-muted hover:text-dark hover:border-gray-300'" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                    Tampilan & Logo
                </button>
                <button type="button" @click="tab = 'sistem'" :class="tab === 'sistem' ? 'border-primary text-primary' : 'border-transparent text-muted hover:text-dark hover:border-gray-300'" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                    Sistem
                </button>
                <button type="button" @click="tab = 'ppdb'" :class="tab === 'ppdb' ? 'border-primary text-primary' : 'border-transparent text-muted hover:text-dark hover:border-gray-300'" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                    Informasi PPDB
                </button>
            </div>

            <!-- Tab: Identitas -->
            <div x-show="tab === 'identitas'" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="school_name" class="block text-sm font-medium text-dark mb-1">Nama Sekolah</label>
                        <input type="text" name="school_name" id="school_name" value="{{ $settings['school_name'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="school_alias" class="block text-sm font-medium text-dark mb-1">Singkatan Sekolah</label>
                        <input type="text" name="school_alias" id="school_alias" value="{{ $settings['school_alias'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label for="school_motto" class="block text-sm font-medium text-dark mb-1">Motto / Tagline Utama (Judul Besar)</label>
                        <input type="text" name="school_motto" id="school_motto" value="{{ $settings['school_motto'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="school_district" class="block text-sm font-medium text-dark mb-1">Nama Wilayah / Daerah (Misal: Sumberagung)</label>
                        <input type="text" name="school_district" id="school_district" value="{{ $settings['school_district'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label for="school_description" class="block text-sm font-medium text-dark mb-1">Deskripsi Singkat (Teks Paragraf Beranda)</label>
                        <textarea name="school_description" id="school_description" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ $settings['school_description'] ?? '' }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label for="footer_copyright" class="block text-sm font-medium text-dark mb-1">Teks Footer Copyright</label>
                        <input type="text" name="footer_copyright" id="footer_copyright" value="{{ $settings['footer_copyright'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Tab: Kontak -->
            <div x-show="tab === 'kontak'" class="space-y-6" style="display: none;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="school_address" class="block text-sm font-medium text-dark mb-1">Alamat Lengkap</label>
                        <textarea name="school_address" id="school_address" rows="2" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ $settings['school_address'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="school_phone" class="block text-sm font-medium text-dark mb-1">Telepon</label>
                        <input type="text" name="school_phone" id="school_phone" value="{{ $settings['school_phone'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="school_email" class="block text-sm font-medium text-dark mb-1">Email</label>
                        <input type="email" name="school_email" id="school_email" value="{{ $settings['school_email'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="school_whatsapp" class="block text-sm font-medium text-dark mb-1">Nomor WhatsApp (Contoh: 628123...)</label>
                        <input type="text" name="school_whatsapp" id="school_whatsapp" value="{{ $settings['school_whatsapp'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="operational_hours" class="block text-sm font-medium text-dark mb-1">Jam Operasional</label>
                        <input type="text" name="operational_hours" id="operational_hours" value="{{ $settings['operational_hours'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label for="school_maps" class="block text-sm font-medium text-dark mb-1">Google Maps Embed HTML</label>
                        <textarea name="school_maps" id="school_maps" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ $settings['school_maps'] ?? '' }}</textarea>
                    </div>
                    
                    <!-- Sosmed -->
                    <div class="md:col-span-2 mt-4"><h3 class="font-semibold text-dark">Sosial Media</h3></div>
                    <div>
                        <label for="social_facebook" class="block text-sm font-medium text-dark mb-1">Facebook URL</label>
                        <input type="text" name="social_facebook" id="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="social_instagram" class="block text-sm font-medium text-dark mb-1">Instagram URL</label>
                        <input type="text" name="social_instagram" id="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="social_youtube" class="block text-sm font-medium text-dark mb-1">YouTube URL</label>
                        <input type="text" name="social_youtube" id="social_youtube" value="{{ $settings['social_youtube'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="social_tiktok" class="block text-sm font-medium text-dark mb-1">TikTok URL</label>
                        <input type="text" name="social_tiktok" id="social_tiktok" value="{{ $settings['social_tiktok'] ?? '' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Tab: Tampilan -->
            <div x-show="tab === 'tampilan'" class="space-y-6" style="display: none;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-dark mb-1">Logo Sekolah</label>
                        @if(!empty($settings['school_logo']))
                            <div class="mb-3">
                                <img src="{{ Storage::url($settings['school_logo']) }}" alt="Logo" class="h-20 object-contain">
                            </div>
                        @endif
                        <input type="file" name="school_logo" accept="image/*" onchange="window.initCropper(this, 1)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-dark mb-1">Favicon</label>
                        @if(!empty($settings['school_favicon']))
                            <div class="mb-3">
                                <img src="{{ Storage::url($settings['school_favicon']) }}" alt="Favicon" class="h-10 object-contain">
                            </div>
                        @endif
                        <input type="file" name="school_favicon" accept="image/*" onchange="window.initCropper(this, 1)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-dark mb-1">Foto Beranda (Bagian Sambutan)</label>
                        @if(!empty($settings['welcome_image']))
                            <div class="mb-3">
                                <img src="{{ Storage::url($settings['welcome_image']) }}" alt="Welcome Image" class="h-40 object-cover rounded-xl">
                            </div>
                        @endif
                        <input type="file" name="welcome_image" accept="image/*" onchange="window.initCropper(this, 4/3)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                        <p class="text-xs text-muted mt-2">Format: JPG, PNG, WEBP. <strong class="text-blue-600">Rekomendasi ukuran: 800x600px (Rasio 4:3)</strong> agar foto tidak terpotong.<br>Gambar ini akan tampil di bagian "Selamat Datang di ..." pada halaman utama (Beranda).</p>
                    </div>

                    <div>
                        <label for="color_primary" class="block text-sm font-medium text-dark mb-1">Warna Utama (Primary)</label>
                        <div class="flex items-center space-x-3">
                            <input type="color" name="color_primary" id="color_primary" value="{{ $settings['color_primary'] ?? '#2563EB' }}" class="h-10 w-10 rounded-lg cursor-pointer">
                            <input type="text" value="{{ $settings['color_primary'] ?? '#2563EB' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary" readonly x-model="$el.previousElementSibling.value">
                        </div>
                    </div>
                    
                    <div>
                        <label for="color_secondary" class="block text-sm font-medium text-dark mb-1">Warna Sekunder (Secondary)</label>
                        <div class="flex items-center space-x-3">
                            <input type="color" name="color_secondary" id="color_secondary" value="{{ $settings['color_secondary'] ?? '#38BDF8' }}" class="h-10 w-10 rounded-lg cursor-pointer">
                            <input type="text" value="{{ $settings['color_secondary'] ?? '#38BDF8' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary" readonly x-model="$el.previousElementSibling.value">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Sistem -->
            <div x-show="tab === 'sistem'" class="space-y-6" style="display: none;">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-dark mb-2">Status Pendaftaran (PPDB)</label>
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="ppdb_status" value="1" class="text-primary focus:ring-primary" {{ ($settings['ppdb_status'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-dark">Buka</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="ppdb_status" value="0" class="text-primary focus:ring-primary" {{ ($settings['ppdb_status'] ?? '1') == '0' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-dark">Tutup</span>
                            </label>
                        </div>
                        <p class="mt-2 text-xs text-muted">Jika dibuka, tombol Daftar Sekarang akan aktif dan mengarah ke WhatsApp.</p>
                    </div>

                    <div>
                        <label for="ppdb_year" class="block text-sm font-medium text-dark mb-1">Tahun Ajaran PPDB</label>
                        <input type="text" name="ppdb_year" id="ppdb_year" value="{{ $settings['ppdb_year'] ?? date('Y').'/'.(date('Y')+1) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Contoh: 2026/2027">
                    </div>

                    <div>
                        <label for="ppdb_date" class="block text-sm font-medium text-dark mb-1">Periode Pendaftaran</label>
                        <input type="text" name="ppdb_date" id="ppdb_date" value="{{ $settings['ppdb_date'] ?? 'Januari - Juli '.date('Y') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Contoh: 1 Juni - 31 Juli 2026">
                    </div>
                </div>
            </div>
            
            <!-- Tab: PPDB -->
            <div x-show="tab === 'ppdb'" class="space-y-6" style="display: none;">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="ppdb_whatsapp_number" class="block text-sm font-medium text-dark mb-1">Nomor WhatsApp Panitia PPDB (Gunakan awalan kode negara tanpa +, contoh: 628123...)</label>
                        <input type="text" name="ppdb_whatsapp_number" id="ppdb_whatsapp_number" value="{{ $settings['ppdb_whatsapp_number'] ?? '6283832286799' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="ppdb_whatsapp_text" class="block text-sm font-medium text-dark mb-1">Teks Pesan Default WhatsApp</label>
                        <input type="text" name="ppdb_whatsapp_text" id="ppdb_whatsapp_text" value="{{ $settings['ppdb_whatsapp_text'] ?? 'Halo Panitia PPDB, saya ingin mendapatkan informasi lebih lanjut mengenai pendaftaran peserta didik baru.' }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="ppdb_info_text" class="block text-sm font-medium text-dark mb-1">Teks Informasi Pendaftaran</label>
                        <textarea name="ppdb_info_text" id="ppdb_info_text" rows="10" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ $settings['ppdb_info_text'] ?? '<div class="flex">
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
</div>' }}</textarea>
                        <p class="text-xs text-muted mt-2">Gunakan editor untuk memformat tampilan informasi. Anda dapat menggunakan list dan penomoran dari editor.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-8 pt-5 border-t border-border flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#ppdb_info_text'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo' ]
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
