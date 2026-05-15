@extends('layouts.admin')

@section('title', 'Kelola Booking')
@section('page-title', 'Manajemen Booking')

@section('content')

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Daftar Kedatangan Pengunjung</h3>
            <p>
                <span class="font-semibold text-bedengan-primary">{{ \Carbon\Carbon::today()->translatedFormat('l, d F Y') }}</span>
            </p>
        </div>

        <div class="flex gap-4">
            <div class="bg-white px-5 py-3 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Total Pesanan</p>
                    <p class="text-lg font-bold text-gray-800">{{ $bookings->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 uppercase text-[11px] font-bold tracking-widest border-b border-gray-100">
                        <th class="px-6 py-5">ID & Waktu</th>
                        <th class="px-6 py-5">Informasi Pengunjung</th>
                        <th class="px-6 py-5 text-center">Jumlah</th>
                        <th class="px-6 py-5">Total Bayar</th>
                        <th class="px-6 py-5 text-center">Status</th>
                        <th class="px-6 py-5 text-right">Aksi Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50/50 transition-all group">
                        
                        <td class="px-6 py-5">
                            <span class="text-gray-800 font-bold block text-sm">#BDG-{{ $booking->id }}</span>
                            <span class="text-[10px] text-gray-400 font-medium">{{ $booking->created_at->format('H:i') }} WIB</span>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-bedengan-surface border border-bedengan-primary/10 flex items-center justify-center text-bedengan-primary font-bold text-sm shadow-sm">
                                    {{ substr($booking->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-gray-800 text-sm">{{ $booking->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $booking->phone ?? $booking->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5 text-center">
                            <span class="px-2.5 py-1 bg-gray-100 rounded-md text-gray-600 font-bold text-xs">
                                {{ $booking->quantity }} Tiket
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            <div class="text-sm font-extrabold text-gray-800">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </div>
                        </td>

                        <td class="px-6 py-5 text-center">
                            @if($booking->status == 'paid')
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-600 border border-green-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    <span class="text-[10px] font-bold uppercase tracking-wider">Lunas</span>
                                </div>
                            @elseif($booking->status == 'waiting_verification')
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-600 border border-amber-100 animate-pulse">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <span class="text-[10px] font-bold uppercase tracking-wider">Perlu Cek</span>
                                </div>
                            @elseif($booking->status == 'failed')
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-600 border border-red-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    <span class="text-[10px] font-bold uppercase tracking-wider">Ditolak</span>
                                </div>
                            @endif
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex justify-end items-center gap-3">
                                @if($booking->payment_proof)
                                    <a href="{{ route('admin.bookings.view_payment', $booking->id) }}" target="_blank" class="text-gray-400 hover:text-indigo-600 transition-colors" title="Lihat Bukti Bayar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                @endif

                                @if($booking->status == 'waiting_verification')
                                    <div class="flex gap-1">
                                        <form action="{{ route('admin.bookings.update_status', $booking->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="status" value="paid" class="p-1.5 bg-green-500 text-white rounded-lg hover:bg-green-600 shadow-sm shadow-green-200 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.update_status', $booking->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="status" value="failed" class="p-1.5 bg-white text-red-500 border border-red-100 rounded-lg hover:bg-red-50 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                </div>
                                <h4 class="text-gray-800 font-bold">Tidak ada kedatangan</h4>
                                <p class="text-gray-400 text-xs mt-1">Belum ada pengunjung yang memesan tiket untuk hari ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection