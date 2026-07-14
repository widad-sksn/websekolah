@extends('layouts.admin')

@section('header', 'Edit Album Galeri')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
            <div class="px-6 py-4 border-b border-border">
                <h2 class="text-lg font-bold text-dark font-display">Edit Informasi</h2>
            </div>
            
            <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="title" class="block text-sm font-medium text-dark mb-1">Judul Album</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-dark mb-1">Deskripsi Singkat</label>
                    <textarea name="description" id="description" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('description', $gallery->description) }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-dark mb-1">Upload Tambahan Foto</label>
                    <input type="file" id="images" name="images[]" multiple accept="image/*" onchange="window.initCropper(this, 16/9)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                    <p class="mt-2 text-xs text-muted">Bisa pilih lebih dari satu foto sekaligus. <br><strong class="text-blue-600">Rekomendasi: 1920x1080px (16:9).</strong> Ukuran bebas tetap bisa diupload, namun sistem otomatis melakukan crop.</p>
                    @error('images.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    
                    <!-- Preview Container -->
                    <div id="image-previews" class="mt-4 grid grid-cols-2 gap-4"></div>
                </div>

                <div class="pt-4 border-t border-border flex justify-end space-x-3">
                    <button type="submit" class="w-full px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">Update Album</button>
                </div>
            </form>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
            <div class="px-6 py-4 border-b border-border flex justify-between items-center">
                <h2 class="text-lg font-bold text-dark font-display">Koleksi Foto</h2>
                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">{{ $gallery->images->count() }} Foto</span>
            </div>
            
            <div class="p-6">
                @if($gallery->images->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($gallery->images as $image)
                    <div class="relative group rounded-xl overflow-hidden border border-border aspect-w-1 aspect-h-1 bg-gray-100">
                        <img src="{{ Storage::url($image->image_path) }}" alt="Gallery Image" class="object-cover w-full h-full">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <form action="{{ route('admin.galleries.images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari album?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none" title="Hapus Foto">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="py-12 text-center text-muted">
                    <p>Belum ada foto dalam album ini.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('images').addEventListener('crop-applied', function(e) {
        const previewContainer = document.getElementById('image-previews');
        previewContainer.innerHTML = '';
        const files = this.files;
        
        if (files.length > 0) {
            let statusMsg = document.getElementById('status-msg-edit');
            if(!statusMsg) {
                statusMsg = document.createElement('p');
                statusMsg.id = 'status-msg-edit';
                statusMsg.className = 'font-medium text-green-600 mt-2 text-sm';
                this.parentNode.insertBefore(statusMsg, previewContainer);
            }
            statusMsg.innerText = `${files.length} foto berhasil dipilih/dipotong dan siap diunggah.`;
        }
        
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative aspect-[16/9] rounded-xl overflow-hidden border border-gray-200 shadow-sm';
                div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                previewContainer.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush
