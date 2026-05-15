@extends('layouts.admin')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Data Pengguna')

@section('content')

<div class="max-w-2xl mx-auto">

    <a href="{{ route('users.index') }}" class="inline-flex items-center text-gray-500 hover:text-bedengan-dark mb-6 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar User
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf

            @method('PUT') 

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bedengan-primary focus:ring-2 focus:ring-bedengan-primary/20 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bedengan-primary focus:ring-2 focus:ring-bedengan-primary/20 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Peran / Role</label>
                <div class="relative">
                    <select name="role_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bedengan-primary focus:ring-2 focus:ring-bedengan-primary/20 outline-none appearance-none bg-white transition-all">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 mt-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                <input type="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah password" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bedengan-primary focus:ring-2 focus:ring-bedengan-primary/20 outline-none transition-all">
                <p class="text-xs text-gray-400 mt-2">Minimal 5 karakter jika diisi.</p>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="bg-bedengan-primary hover:bg-green-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-green-500/30 transition-all transform hover:-translate-y-1">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection