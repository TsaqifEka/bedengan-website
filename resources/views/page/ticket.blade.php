@extends('app')

@section('title', 'Home - Bedengan Camping Ground')

@section('content')
        <section class="h-20 bg-transparent"></section> 
        <div class="text-center mb-8 px-4">
            <span class="text-bedengan-primary font-medium text-sm tracking-wide">Book Your Visit</span>
            <h1 class="font-serif text-4xl md:text-5xl font-bold text-bedengan-dark mt-2 mb-2">Ticket Booking</h1>
            <p class="text-gray-500 text-sm">Reserve your spot at Bedengan Camping Ground</p>
        </div>

        <div class="flex justify-center items-center gap-4 mb-12">
            <div class="w-10 h-10 rounded-full bg-bedengan-primary text-white flex items-center justify-center font-bold shadow-lg">1</div>
            
            <div class="w-16 h-1 bg-gray-200 rounded-full"></div>
            
            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">2</div>
            
            <div class="w-16 h-1 bg-gray-200 rounded-full"></div>
            
            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">3</div>
        </div>

        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-[2rem] p-8 md:p-10 border border-gray-100 shadow-xl">
                
                <h3 class="font-serif text-2xl font-bold text-bedengan-dark mb-6">Select Your Visit Details</h3>
                
                <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Visit Date</label>
                        <div class="relative">
                            <input type="text" id="datePicker" name="visit_date" class="w-full px-4 py-3 rounded-xl border border-bedengan-primary text-gray-700 focus:outline-none focus:ring-1 focus:ring-bedengan-primary bg-white cursor-pointer pl-11" placeholder="Pick a date">
                            <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>

<div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-3">Ticket Type</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <label class="cursor-pointer group relative">
                    <input type="radio" name="ticketType" value="10000" class="peer sr-only" checked onchange="updateTotal()">
                    
                    <div class="p-5 rounded-xl border border-gray-300 bg-white hover:border-bedengan-primary transition-all h-full flex flex-col justify-between 
                                peer-checked:border-bedengan-primary peer-checked:bg-green-50 peer-checked:ring-1 peer-checked:ring-bedengan-primary">
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">Day Pass</h4>
                            <p class="text-sm text-gray-500 mb-3">For day visits & picnics (Non-camping)</p>
                        </div>
                        <div class="font-bold text-bedengan-primary ticket-price text-lg">Rp 10.000</div>
                    </div>
                    
                    <div class="absolute top-4 right-4 text-bedengan-primary opacity-0 peer-checked:opacity-100 transition-opacity">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </label>
                
                <label class="cursor-pointer group relative">
                    <input type="radio" name="ticketType" value="25000" class="peer sr-only" onchange="updateTotal()">
                    
                    <div class="p-5 rounded-xl border border-gray-300 bg-white hover:border-bedengan-primary transition-all h-full flex flex-col justify-between 
                                peer-checked:border-bedengan-primary peer-checked:bg-green-50 peer-checked:ring-1 peer-checked:ring-bedengan-primary">
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">Camping Pass</h4>
                            <p class="text-sm text-gray-500 mb-3">For overnight stays & camping</p>
                        </div>
                        <div class="font-bold text-bedengan-primary ticket-price text-lg">Rp 25.000</div>
                    </div>

                    <div class="absolute top-4 right-4 text-bedengan-primary opacity-0 peer-checked:opacity-100 transition-opacity">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </label>
                
            </div>
        </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Number of Visitors</label>
                        <div class="flex items-center gap-3">
                            <button type="button" onclick="updateCount(-1)" class="w-10 h-10 rounded-lg border border-bedengan-primary text-bedengan-primary hover:bg-bedengan-primary hover:text-white transition flex items-center justify-center text-xl font-medium bg-white">
                                −
                            </button>
                            
                            <div class="w-16 h-10 flex items-center justify-center bg-gray-200 rounded-lg">
                                <span class="text-lg font-bold text-gray-800 flex gap-2 items-center">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    <span id="visitorCountDisplay">1</span>
                                </span>
                                <input type="hidden" id="visitorCountInput" name="quantity" value="1">
                            </div>

                            <button type="button" onclick="updateCount(1)" class="w-10 h-10 rounded-lg border border-bedengan-primary text-bedengan-primary hover:bg-bedengan-primary hover:text-white transition flex items-center justify-center text-xl font-medium bg-white">
                                +
                            </button>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h4 class="font-bold text-gray-800 mb-4">Contact Information</h4>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Full Name</label>
                                <input type="text" required name="name" placeholder="Enter your name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-bedengan-primary focus:ring-1 focus:ring-bedengan-primary transition-colors bg-white">
                            </div>
                            
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Email</label>
                                <input type="email" required name="email" placeholder="Enter your email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-bedengan-primary focus:ring-1 focus:ring-bedengan-primary transition-colors bg-white">
                            </div>
                            
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Phone Number</label>
                                <input type="tel" required name="phone" placeholder="Enter your phone number" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-bedengan-primary focus:ring-1 focus:ring-bedengan-primary transition-colors bg-white">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-10 pt-6 border-t border-gray-200">
                        <div>
                            <p class="text-gray-600 text-lg">Total</p>
                            <h3 class="text-2xl font-bold text-bedengan-primary" id="totalPriceDisplay">Rp 25.000</h3>
                        </div>
                        
                        <button type="submit" class="bg-bedengan-primary hover:bg-green-600 text-white font-medium px-8 py-3 rounded-lg shadow-md transition-all transform hover:-translate-y-0.5">
                            Continue to Payment
                        </button>
                    </div>

                </form>
            </div>
        </div>
        <section class="h-20 bg-transparent"></section> 
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Init Datepicker
            flatpickr("#datePicker", {
                dateFormat: "Y-m-d",
                minDate: "today",
                defaultDate: "today"
            });
            
            // Hitung total awal saat halaman dimuat
            updateTotal();
        });

        // Variabel global untuk jumlah
        let count = 1;

        // 2. Fungsi Update Jumlah Pengunjung
        function updateCount(change) {
            count += change;
            if (count < 1) count = 1;
            
            // Update input hidden (untuk dikirim ke controller)
            // Di HTML ID-nya 'visitorCountInput', jadi di sini harus sama
            document.getElementById('visitorCountInput').value = count;
            
            // Update tampilan angka
            document.getElementById('visitorCountDisplay').innerText = count;
            
            // Update Total Harga
            updateTotal();
        }

        // 3. Fungsi Hitung Total Harga
        function updateTotal() {
            // Ambil harga tiket yang dipilih
            const ticketTypeInput = document.querySelector('input[name="ticketType"]:checked');
            
            if (ticketTypeInput) {
                const ticketPrice = parseInt(ticketTypeInput.value);
                const total = ticketPrice * count;
                
                // Format Rupiah
                const formatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(total);
                
                // Bersihkan format (hapus IDR, ganti Rp jika perlu, atau biarkan default currency)
                // Kode ini membuat format "Rp 25.000"
                const cleanFormat = formatted.replace("IDR", "Rp").trim();

                document.getElementById('totalPriceDisplay').innerText = cleanFormat;
            }
        }
    </script>
@endpush