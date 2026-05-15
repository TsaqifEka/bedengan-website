@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')
@section('page-title', 'Tambah Pengguna Baru')

@section('content')

<div class="max-w-2xl mx-auto">
    <a href="{{ route('users.index') }}" class="inline-flex items-center text-gray-500 hover:text-bedengan-dark mb-6 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar User
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        
        <div class="mb-8 border-b border-gray-100 pb-4">
            <h3 class="text-xl font-bold text-gray-800">Formulir Pendaftaran</h3>
            <p class="text-gray-500 text-sm mt-1">Silakan lengkapi data untuk membuat akun baru.</p>
        </div>

        <!-- form -->
        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bedengan-primary focus:ring-2 focus:ring-bedengan-primary/20 outline-none transition-all placeholder:text-gray-300">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bedengan-primary focus:ring-2 focus:ring-bedengan-primary/20 outline-none transition-all placeholder:text-gray-300">
            </div>

            <!-- role penting -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Peran / Role</label>
                <div class="relative">
                    <select name="role_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bedengan-primary focus:ring-2 focus:ring-bedengan-primary/20 outline-none appearance-none bg-white transition-all cursor-pointer">
                        <option value="" disabled selected>-- Pilih Peran --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required placeholder="Minimal 5 karakter"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bedengan-primary focus:ring-2 focus:ring-bedengan-primary/20 outline-none transition-all placeholder:text-gray-300">
                <p class="text-xs text-gray-400 mt-2">Password wajib diisi untuk pengguna baru.</p>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="bg-bedengan-primary hover:bg-green-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-green-500/30 transition-all transform hover:-translate-y-1 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat User Baru
                </button>
            </div>

        </form>
    </div>
</div>
@endsection