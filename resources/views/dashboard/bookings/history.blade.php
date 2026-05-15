@extends('layouts.app') {{-- Sesuaikan dengan nama file layout utama Anda --}}

@section('title', 'Riwayat Tiket Saya - Bedengan')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28 pb-12 px-6">
    <div class="max-w-7xl mx-auto">
        
        <div class="mb-8">
            <h1 class="font-serif text-3xl font-bold text-bedengan-dark mb-2">Riwayat Tiket</h1>
            <p class="text-gray-500">Lihat semua status pemesanan camping dan tiket masuk Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- 
               LOOPING DATA (CONTOH)
               Nanti ganti variable $bookings sesuai data dari Controller
            --}}
            @forelse($bookings as $booking)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                    
                    <div class="px-5 py-4 border-b border-gray-50 flex justify-between items-start bg-gray-50/50">
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Order ID</p>
                            <span class="font-mono text-sm font-bold text-gray-700">#{{ $booking->code ?? 'TRX-001' }}</span>
                        </div>
                        
                        {{-- Logika Badge Status --}}
                        @php
                            $statusClass = match($booking->status) {
                                'paid', 'success' => 'bg-green-100 text-green-700 border-green-200',
                                'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                'cancelled', 'failed' => 'bg-red-100 text-red-700 border-red-200',
                                default => 'bg-gray-100 text-gray-700 border-gray-200',
                            };
                            
                            $statusLabel = match($booking->status) {
                                'paid', 'success' => 'Berhasil',
                                'pending' => 'Menunggu',
                                'cancelled', 'failed' => 'Dibatalkan',
                                default => ucfirst($booking->status),
                            };
                        @endphp
                        
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="p-5 flex-1">
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="p-2 rounded-lg bg-bedengan-surface text-bedengan-primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Jadwal Camping</p>
                                    <p class="font-medium text-gray-800">
                                        {{-- Format Tanggal --}}
                                        {{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{-- Durasi (Opsional) --}}
                                        {{ \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out ?? now()) }} Malam
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="p-2 rounded-lg bg-bedengan-surface text-bedengan-primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Total Pembayaran</p>
                                    <p class="font-bold text-bedengan-dark text-lg">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex gap-2">
                        {{-- Tombol Detail --}}
                        <a href="{{ route('booking.show', $booking->id) }}" class="flex-1 text-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-bedengan-dark transition">
                            Detail
                        </a>
                        
                        {{-- Tombol Bayar (Jika Pending) --}}
                        @if($booking->status == 'pending')
                            <a href="{{ route('booking.payment', $booking->id) }}" class="flex-1 text-center px-4 py-2 bg-bedengan-primary text-white rounded-lg text-sm font-semibold hover:bg-green-600 transition shadow-sm">
                                Bayar
                            </a>
                        @endif
                    </div>
                </div>

            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-gray-300">
                    <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <h3 class="text-lg font-serif font-bold text-gray-800 mb-2">Belum ada tiket</h3>
                    <p class="text-gray-500 mb-6 max-w-sm mx-auto">Anda belum pernah melakukan pemesanan tiket camping atau sewa alat sebelumnya.</p>
                    <a href="{{ route('booking.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-bedengan-primary text-white font-semibold hover:bg-green-600 transition shadow-lg shadow-green-900/20">
                        Pesan Tiket Sekarang
                    </a>
                </div>
            @endforelse

        </div>

        <div class="mt-8">
            {{ $bookings->links() }}
        </div>

    </div>
</div>
@endsection