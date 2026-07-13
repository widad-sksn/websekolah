@extends('layouts.admin')

@section('header', 'Data Prestasi')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border flex justify-between items-center">
        <h2 class="text-lg font-bold text-dark font-display">Daftar Prestasi</h2>
        <a href="{{ route('admin.achievements.create') }}" class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors">
            + Tambah Prestasi
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 text-muted">
                <tr>
                    <th class="px-6 py-4 font-medium">Judul Prestasi</th>
                    <th class="px-6 py-4 font-medium">Bidang/Kategori</th>
                    <th class="px-6 py-4 font-medium">Tingkat</th>
                    <th class="px-6 py-4 font-medium">Tahun</th>
                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($achievements as $achievement)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($achievement->photo)
                                <img src="{{ Storage::url($achievement->photo) }}" alt="{{ $achievement->title }}" class="w-12 h-12 rounded-lg object-cover mr-3 border border-gray-200">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-yellow-50 text-yellow-500 flex items-center justify-center mr-3 border border-yellow-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                </div>
                            @endif
                            <div>
                                <span class="font-medium text-dark">{{ $achievement->title }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-muted">{{ $achievement->category ?? '-' }}</td>
                    <td class="px-6 py-4 text-muted">{{ $achievement->level ?? '-' }}</td>
                    <td class="px-6 py-4 text-muted">{{ $achievement->year ?? '-' }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.achievements.edit', $achievement->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.achievements.destroy', $achievement->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data prestasi ini?');">
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
                    <td colspan="5" class="px-6 py-8 text-center text-muted">Belum ada data prestasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($achievements->hasPages())
    <div class="px-6 py-4 border-t border-border">
        {{ $achievements->links() }}
    </div>
    @endif
</div>
@endsection
