@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Manajemen Data Pengguna')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-gray-700 font-medium">Daftar semua pengguna terdaftar</h3>
        </div>
        <a href="{{ route('users.create') }}" class="bg-bedengan-primary hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-green-500/30 flex items-center gap-2 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah User
        </a>
    </div>

    <!-- tabel user -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider border-b border-gray-100">
                        <th class="p-5 font-semibold">No</th>
                        <th class="p-5 font-semibold">Nama Lengkap</th>
                        <th class="p-5 font-semibold">Email</th>
                        <th class="p-5 font-semibold">Role / Peran</th>
                        <th class="p-5 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $index => $user)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="p-5 text-gray-500">{{ $index + 1 }}</td>
                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-sm">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="font-semibold text-gray-700">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="p-5 text-gray-600">{{ $user->email }}</td>
                        <td class="p-5">
                            @if($user->role->name == 'Admin')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-700 border border-blue-200">
                                    Admin
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                    Pengunjung
                                </span>
                            @endif
                        </td>
                        <td class="p-5 text-center">
                            <div class="flex justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">

                                <a href="{{ route('users.edit', $user->id) }}" class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 border border-yellow-200" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 border border-red-200" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">
                            Belum ada data user.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginasi (Jika pakai paginate) --}}
        {{-- <div class="p-5 border-t border-gray-100">
            {{ $users->links() }}
        </div> --}}
    </div>

@endsection