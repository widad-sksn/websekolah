@extends('layouts.admin')

@section('header', 'Slider Beranda')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border flex justify-between items-center">
        <h2 class="text-lg font-bold text-dark font-display">Daftar Slider</h2>
        <a href="{{ route('admin.sliders.create') }}" class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors">
            + Tambah Slider
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 text-muted">
                <tr>
                    <th class="px-6 py-4 font-medium">Gambar</th>
                    <th class="px-6 py-4 font-medium">Teks</th>
                    <th class="px-6 py-4 font-medium">Urutan</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($sliders as $slider)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <img src="{{ Storage::url($slider->image) }}" alt="Slider" class="h-16 w-32 object-cover rounded-lg border border-border">
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-medium text-dark">{{ $slider->title ?? '-' }}</p>
                        <p class="text-xs text-muted">{{ $slider->subtitle ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-muted">{{ $slider->order }}</td>
                    <td class="px-6 py-4">
                        @if($slider->status)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus slider ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-muted">Belum ada slider.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($sliders->hasPages())
    <div class="px-6 py-4 border-t border-border">
        {{ $sliders->links() }}
    </div>
    @endif
</div>
@endsection
