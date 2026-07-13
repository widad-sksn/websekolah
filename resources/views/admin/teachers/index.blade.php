@extends('layouts.admin')

@section('header', 'Guru & Staff')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border flex justify-between items-center">
        <h2 class="text-lg font-bold text-dark font-display">Data Guru & Staff</h2>
        <a href="{{ route('admin.teachers.create') }}" class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors">
            + Tambah Data
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 text-muted">
                <tr>
                    <th class="px-6 py-4 font-medium">Profil</th>
                    <th class="px-6 py-4 font-medium">NIP</th>
                    <th class="px-6 py-4 font-medium">Jabatan</th>
                    <th class="px-6 py-4 font-medium">Mata Pelajaran</th>
                    <th class="px-6 py-4 font-medium">Urutan</th>
                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($teachers as $teacher)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($teacher->photo)
                                <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}" class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-200">
                            @else
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center mr-3 font-bold border border-blue-200">
                                    {{ substr($teacher->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="font-medium text-dark">{{ $teacher->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-muted">{{ $teacher->nip ?? '-' }}</td>
                    <td class="px-6 py-4 text-muted">{{ $teacher->position ?? '-' }}</td>
                    <td class="px-6 py-4 text-muted">{{ $teacher->subject ?? '-' }}</td>
                    <td class="px-6 py-4 text-muted">{{ $teacher->order }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                    <td colspan="6" class="px-6 py-8 text-center text-muted">Belum ada data guru/staff.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($teachers->hasPages())
    <div class="px-6 py-4 border-t border-border">
        {{ $teachers->links() }}
    </div>
    @endif
</div>
@endsection
