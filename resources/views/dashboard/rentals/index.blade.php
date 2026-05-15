@extends('layouts.admin')

@section('title', 'Kelola Rental')
@section('page-title', 'Manajemen Rental Peralatan')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-gray-700 font-medium">Daftar pesanan rental masuk</h3>
            <p class="text-xs text-gray-400 mt-1">Total Pesanan: {{ $rentals->count() }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-5 text-gray-600 uppercase text-xs tracking-wider border-b border-gray-100">
                        <th class="p-5 font-semibold">ID</th>
                        <th class="p-5 font-semibold">Penyewa</th>
                        <th class="p-5 font-semibold">Tanggal Rental</th>
                        <th class="p-5 font-semibold">Durasi</th>
                        <th class="p-5 font-semibold">Barang</th>
                        <th class="p-5 font-semibold">Total</th>
                        <th class="p-5 font-semibold text-center">Bukti Bayar</th>
                        <th class="p-5 font-semibold">Status</th>
                        <th class="p-5 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($rentals as $rental)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        
                        <td class="p-5 text-gray-500 font-mono text-xs">#{{ $rental->id }}</td>

                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-bedengan-surface border border-bedengan-primary/20 flex items-center justify-center text-bedengan-primary font-bold text-sm">
                                    {{ substr($rental->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-700">{{ $rental->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $rental->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="p-5 text-gray-600 text-sm">
                            {{ \Carbon\Carbon::parse($rental->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($rental->end_date)->format('d M Y') }}
                        </td>

                        <td class="p-5 text-gray-600 text-sm">
                            {{ $rental->duration_days }} hari
                        </td>

                        <td class="p-5 text-gray-600 text-sm">
                            <div class="space-y-1">
                                @forelse($rental->items as $item)
                                    <div class="bg-gray-50 px-2 py-1 rounded text-xs">
                                        {{ $item->equipment->name }} x{{ $item->quantity }}
                                    </div>
                                @empty
                                    <span class="text-gray-400 italic">-</span>
                                @endforelse
                            </div>
                        </td>

                        <td class="p-5 font-semibold text-gray-700">
                            Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                        </td>

                        <td class="p-5 text-center">
                            @if($rental->payment_proof)
                                <a href="{{ asset('payment_proofs/' . $rental->payment_proof) }}" target="_blank" class="px-3 py-1.5 text-xs font-medium rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors inline-flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Lihat
                                </a>
                            @else
                                <span class="text-xs text-gray-400 italic">Belum Upload</span>
                            @endif
                        </td>

                        <td class="p-5">
                            @if($rental->status == 'paid')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200">
                                    Lunas
                                </span>
                            @elseif($rental->status == 'waiting_verification')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200 flex items-center w-fit gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                                    Perlu Cek
                                </span>
                            @elseif($rental->status == 'failed')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700 border border-red-200">
                                    Ditolak
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                    Pending
                                </span>
                            @endif
                        </td>

                        <td class="p-5 text-center">
                            @if($rental->status == 'waiting_verification')
                                <div class="flex justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    
                                    <form action="{{ route('admin.rentals.update_status', $rental->id) }}" method="POST" onsubmit="return confirm('Terima pembayaran ini?')">
                                        @csrf
                                        <button type="submit" name="status" value="paid" class="p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 border border-green-200 transition-colors" title="Terima (Acc)">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.rentals.update_status', $rental->id) }}" method="POST" onsubmit="return confirm('Tolak pembayaran ini?')">
                                        @csrf
                                        <button type="submit" name="status" value="failed" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 border border-red-200 transition-colors" title="Tolak">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </form>

                                </div>
                            @elseif($rental->status == 'paid')
                                <span class="text-green-500">
                                    <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="p-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                <p>Belum ada data pesanan rental.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

