@extends('app')

@section('content')
<main class="pt-24 pb-20 bg-white min-h-screen">
    
    <div class="text-center mb-12 px-4">
        <h1 class="font-serif text-4xl font-bold text-bedengan-dark mb-2">History Tiket</h1>
        <p class="text-gray-500">Lihat semua tiket yang Anda pesan</p>
    </div>

    <div class="max-w-4xl mx-auto px-4">
        
        @if($bookings->isEmpty())
            <div class="text-center py-16 bg-gray-50 rounded-xl">
                <p class="text-gray-500 mb-4">Anda belum memiliki tiket yang dipesan</p>
                <a href="{{ route('booking.index') }}" class="inline-block px-6 py-2 bg-bedengan-primary text-white font-semibold rounded-lg hover:bg-bedengan-dark">
                    Pesan Tiket
                </a>
            </div>
        @else

            @foreach($bookings as $booking)
            <div class="mb-4 bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-500">ID Tiket</p>
                        <p class="font-bold text-lg">#{{ $booking->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Kunjung</p>
                        <p class="font-semibold">{{ date('d M Y', strtotime($booking->visit_date)) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Tiket</p>
                        <p class="font-semibold">{{ $booking->quantity }} tiket</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total</p>
                        <p class="font-bold text-bedengan-primary">Rp {{ number_format($booking->total_price) }}</p>
                    </div>
                </div>

                <hr class="my-4">

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="font-semibold text-sm">{{ $booking->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-semibold text-sm">{{ $booking->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">HP</p>
                        <p class="font-semibold text-sm">{{ $booking->phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        @if($booking->status == 'unpaid')
                            <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded">Belum Bayar</span>
                        @elseif($booking->status == 'waiting_verification')
                            <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded">Verifikasi</span>
                        @elseif($booking->status == 'paid')
                            <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded">Lunas</span>
                        @endif
                    </div>
                </div>

                <div class="flex gap-2 flex-wrap">
                    @if($booking->status == 'unpaid')
                        <a href="{{ route('booking.payment', $booking->id) }}" class="px-4 py-2 bg-bedengan-primary text-white text-sm font-semibold rounded hover:bg-bedengan-dark">
                            Lanjutkan Bayar
                        </a>
                    @endif
                </div>

            </div>
            @endforeach

        @endif

    </div>

</main>
@endsection
