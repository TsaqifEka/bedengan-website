@extends('layouts.admin')

@section('title', 'Kelola Equipment - Bedengan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-bedengan-dark">Kelola Equipment</h1>
                <p class="text-gray-500 mt-1">Manage semua perlengkapan rental</p>
            </div>
            <a href="{{ route('admin.equipment.create') }}" class="bg-bedengan-primary hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg shadow-lg transition-all transform hover:-translate-y-0.5">
                + Tambah Equipment
            </a>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Equipment Table --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Gambar</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Equipment</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Harga/Hari</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Stok</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($equipments as $equipment)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $equipment->id }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($equipment->image)
                                    <img src="{{ asset('storage/' . $equipment->image) }}" class="w-16 h-16 rounded-lg object-cover shadow-sm" alt="{{ $equipment->name }}">
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center text-gray-400 text-xs">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $equipment->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ Str::limit($equipment->description ?? '-', 50) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <span class="text-green-600 font-semibold">Rp {{ number_format($equipment->price, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $equipment->quantity }} unit
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.equipment.edit', $equipment->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-xs font-semibold transition-colors">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.equipment.destroy', $equipment->id) }}" method="POST" onsubmit="return confirm('Yakin hapus equipment ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-semibold transition-colors">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Belum ada equipment. <a href="{{ route('admin.equipment.create') }}" class="text-bedengan-primary font-semibold hover:underline">Tambah sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
