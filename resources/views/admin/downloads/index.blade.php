@extends('layouts.admin')

@section('header', 'Pusat Unduhan')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border flex justify-between items-center">
        <h2 class="text-lg font-bold text-dark font-display">Daftar File</h2>
        <a href="{{ route('admin.downloads.create') }}" class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors">
            + Upload File
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 text-muted">
                <tr>
                    <th class="px-6 py-4 font-medium">Nama File</th>
                    <th class="px-6 py-4 font-medium">Tipe</th>
                    <th class="px-6 py-4 font-medium">Ukuran</th>
                    <th class="px-6 py-4 font-medium">Tanggal Upload</th>
                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($downloads as $download)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <span class="font-medium text-dark block">{{ Str::limit($download->title, 40) }}</span>

                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-muted uppercase">{{ pathinfo($download->file_path, PATHINFO_EXTENSION) }}</td>
                    <td class="px-6 py-4 text-muted">
                        {{ number_format($download->size / 1024, 2) }} KB
                    </td>
                    <td class="px-6 py-4 text-muted">{{ $download->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ Storage::url($download->file_path) }}" target="_blank" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Download">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                            <a href="{{ route('admin.downloads.edit', $download->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.downloads.destroy', $download->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus file ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-muted">Belum ada file unduhan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($downloads->hasPages())
    <div class="px-6 py-4 border-t border-border">
        {{ $downloads->links() }}
    </div>
    @endif
</div>
@endsection
