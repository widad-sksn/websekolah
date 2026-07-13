@extends('layouts.admin')

@section('header', 'Edit Pengguna')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
    <div class="px-6 py-4 border-b border-border">
        <h2 class="text-lg font-bold text-dark font-display">Edit Informasi Pengguna</h2>
    </div>
    
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-6 space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-medium text-dark mb-1">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-dark mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        
        <div class="bg-gray-50 p-4 rounded-xl border border-border">
            <h3 class="text-sm font-semibold text-dark mb-3">Ubah Password (Opsional)</h3>
            <p class="text-xs text-muted mb-4">Biarkan kosong jika tidak ingin mengubah password.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-dark mb-1">Password Baru</label>
                    <input type="password" name="password" id="password" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-dark mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>
            </div>
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-dark mb-1">Role / Peran</label>
            <select name="role" id="role" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ (old('role') ?? $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
            @if($user->id === auth()->id())
                <input type="hidden" name="role" value="{{ $user->roles->first()?->name }}">
                <p class="mt-1 text-xs text-orange-600">Anda tidak dapat mengubah role Anda sendiri.</p>
            @endif
            @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-border">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">Update Data</button>
        </div>
    </form>
</div>
@endsection
