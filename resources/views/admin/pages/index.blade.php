@extends('layouts.admin')

@section('header', 'Halaman Statis')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border flex justify-between items-center">
        <h2 class="text-lg font-bold text-dark font-display">Daftar Halaman</h2>
        <a href="{{ route('admin.pages.create') }}" class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors">
            + Tambah Halaman
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 text-muted">
                <tr>
                    <th class="px-6 py-4 font-medium">Judul Halaman</th>
                    <th class="px-6 py-4 font-medium">URL (Slug)</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($pages as $page)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="font-medium text-dark">{{ $page->title }}</span>
                    </td>
                    <td class="px-6 py-4 text-muted">/page/{{ $page->slug }}</td>
                    <td class="px-6 py-4">
                        @if($page->status == 'published')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Published</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus halaman ini?');">
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
                    <td colspan="4" class="px-6 py-8 text-center text-muted">Belum ada halaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($pages->hasPages())
    <div class="px-6 py-4 border-t border-border">
        {{ $pages->links() }}
    </div>
    @endif
</div>
@endsection
