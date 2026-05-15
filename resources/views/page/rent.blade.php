@extends ('app')

@section('title', 'Rent - Bedengan Camping Ground')

@section('content')

    <section class="h-20 bg-transparent"></section>     
    <div class="text-center mb-8 px-4">
        <span class="text-bedengan-primary font-medium text-sm tracking-wide uppercase">Gear Up</span>
        <h1 class="font-serif text-4xl md:text-5xl font-bold text-bedengan-dark mt-2 mb-4">Equipment Rental</h1>
        <p class="text-gray-500 text-sm">Rent quality camping gear for your adventure</p>
    </div>

    <div class="flex justify-center items-center gap-4 mb-12">
        <div class="w-10 h-10 rounded-full bg-bedengan-primary text-white flex items-center justify-center font-bold shadow-lg">1</div>
        <div class="w-16 h-1 bg-gray-200 rounded-full"></div>
        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">2</div>
        <div class="w-16 h-1 bg-gray-200 rounded-full"></div>
        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">3</div>
    </div>

    {{-- FORM START --}}
    <form action="{{ route('rent.store') }}" method="POST">
    @csrf

        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-[2rem] p-8 md:p-10 border border-gray-100 shadow-xl">
                
                {{-- 1. PILIH TANGGAL --}}
                <h3 class="font-serif text-xl font-bold text-bedengan-dark mb-6">Rental Period</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div>
                        <label class="block text-sm text-gray-600 mb-2">Start Date</label>
                        <div class="relative">
                            <input type="text" name="start_date" id="startDate" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:border-bedengan-primary bg-white pl-11" placeholder="Pick start date">
                            <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-2">End Date</label>
                        <div class="relative">
                            <input type="text" name="end_date" id="endDate" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:border-bedengan-primary bg-white pl-11" placeholder="Pick end date">
                            <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                </div>

                <h3 class="font-serif text-xl font-bold text-bedengan-dark mb-6">Select Equipment</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    
                    @foreach($equipments as $item)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col h-full" data-equipment-id="{{ $item->id }}">

                            <div class="relative h-48 w-full bg-gray-100 {{ !$item->is_available ? 'opacity-60' : '' }}" data-available-check>
                                {{--
                                PENTING: Sesuaikan 'src' ini dengan cara kamu menyimpan gambar.
                                Contoh jika pakai storage link: asset('storage/' . $item->image)
                                Ini saya pakai placeholder dulu agar tidak error jika gambarnya null.
                                --}}
                                <img
                                    src="{{ !empty($item->image) ? asset('storage/' . $item->image) : 'https://via.placeholder.com/400x300.png?text=' . urlencode($item->name) }}"
                                    alt="{{ $item->name }}"
                                    class="w-full h-full object-cover"
                                >
                                @if(!$item->is_available)
                                    <div class="absolute inset-0 bg-red-600/30 flex items-center justify-center" data-availability-badge>
                                        <span class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold text-sm">Tidak Tersedia</span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-5 flex flex-col flex-grow">

                                <div class="mb-4">
                                    {{-- HAPUS badge harga lama di sini jika masih ada --}}
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">
                                        {{ $item->name }}
                                    </h3>
                                    {{-- 'line-clamp-2' membatasi deskripsi max 2 baris agar rapi --}}
                                    <p class="text-sm text-gray-500 line-clamp-2" title="{{ $item->description }}">
                                        {{ $item->description }}
                                    </p>
                                    <div class="mt-2 text-xs" data-available-text>
                                        @if($item->is_available)
                                            <span class="text-green-600 font-semibold">✓ Tersedia: {{ $item->available }} unit</span>
                                        @else
                                            <span class="text-red-600 font-semibold">✗ Habis di tanggal ini</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- 'mt-auto' adalah kunci agar bagian ini selalu nempel di bawah card --}}
                                <div class="flex items-end justify-between mt-auto pt-3 border-t border-gray-50">

                                    <div class="flex flex-col">
                                        <span class="text-[11px] uppercase tracking-wider text-gray-400 font-medium">Price tag</span>
                                        <div class="flex items-baseline -mt-1">
                                            <span class="text-xl font-semibold text-green-600 mr-1">Rp</span>
                                            <span class="text-2xl font-extrabold text-green-600">
                                                {{ number_format($item->price, 0, ',', '.') }}
                                            </span>
                                            <span class="text-sm text-gray-500 ml-1 font-medium">/day</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center bg-gray-50 rounded-lg p-1 border border-gray-200 shadow-sm {{ !$item->is_available ? 'opacity-50 cursor-not-allowed' : '' }}" data-qty-controls>
                                        
                                        <input type="hidden" name="items[{{ $item->id }}]" id="input-qty-{{ $item->id }}" value="0">

                                        <button type="button" 
                                                onclick="updateQty({{ $item->id }}, -1, {{ $item->price }})"
                                                {{ !$item->is_available ? 'disabled' : '' }}
                                                class="w-8 h-8 rounded-md bg-white text-gray-500 hover:border-gray-500 border border-transparent flex items-center justify-center transition-colors focus:outline-none active:bg-gray-100 {{ !$item->is_available ? 'cursor-not-allowed' : '' }}"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <span class="font-bold text-gray-700 w-8 text-center" id="display-qty-{{ $item->id }}">0</span>

                                        <button type="button" 
                                                onclick="updateQty({{ $item->id }}, 1, {{ $item->price }})"
                                                {{ !$item->is_available ? 'disabled' : '' }}
                                                class="w-8 h-8 rounded-md bg-white text-green-600 hover:bg-green-500 hover:text-white border border-green-200 hover:border-transparent flex items-center justify-center transition-all focus:outline-none active:scale-95 shadow-sm {{ !$item->is_available ? 'cursor-not-allowed opacity-50' : '' }}"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                                </div>
                        </div>
                    @endforeach

                </div>

                {{-- 3. KONTAK INFO --}}
                <div class="pt-6 border-t border-gray-200">
                    <h3 class="font-serif text-xl font-bold text-bedengan-dark mb-6">Contact Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Full Name</label>
                            <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" placeholder="Enter your name" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:border-bedengan-primary bg-white transition-colors" required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" placeholder="Enter your email" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:border-bedengan-primary bg-white transition-colors" required>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Phone Number</label>
                                <input type="tel" name="phone" value="{{ Auth::user()->phone ?? '' }}" placeholder="Enter your phone number" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:border-bedengan-primary bg-white transition-colors" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 4. TOTAL & SUBMIT --}}
                <div class="flex flex-col md:flex-row items-center justify-between mt-10 pt-6 border-t border-gray-200 gap-4">
                    <div class="text-center md:text-left">
                        <p class="text-gray-500 text-sm">Total (<span id="daysCount">1</span> day)</p>
                        <h3 class="text-3xl font-bold text-bedengan-primary" id="totalPrice">Rp 0</h3>
                    </div>
                    
                    <button type="submit" class="w-full md:w-auto bg-bedengan-primary hover:bg-green-600 text-white font-bold text-lg px-10 py-3 rounded-xl shadow-lg shadow-green-500/30 transition-all text-center transform hover:-translate-y-0.5">
                        Continue to Payment
                    </button>
                </div>

            </div>
        </div>
    </form>
    {{-- FORM END --}}

    <section class="h-20 bg-transparent"></section>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        let duration = 1; // Default 1 hari
        let itemSubtotals = {}; // Menyimpan total harga per item

        document.addEventListener('DOMContentLoaded', function() {
            // --- 1. LOGIKA TANGGAL (FLATPICKR) ---
            const fpStart = flatpickr("#startDate", {
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    fpEnd.set('minDate', dateStr); // Tanggal akhir tidak boleh sebelum tanggal awal
                    calculateDuration();
                }
            });

            const fpEnd = flatpickr("#endDate", {
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    calculateDuration();
                }
            });

            function calculateDuration() {
                const start = fpStart.selectedDates[0];
                const end = fpEnd.selectedDates[0];

                if (start && end) {
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                    
                    // Jika tanggal sama, hitung 1 hari. Jika beda, hitung selisihnya + 1 (inklusif) atau sesuai kebijakan rentalmu
                    // Di sini saya buat logika: sewa tgl 1 s/d tgl 2 = 1 hari (24 jam)
                    duration = diffDays === 0 ? 1 : diffDays; 
                    
                    // Refresh availability berdasarkan tanggal yang dipilih
                    // Ambil value langsung dari input (sudah format Y-m-d) untuk avoid timezone issue
                    const dateStr = document.getElementById('startDate').value;
                    refreshAvailability(dateStr);
                } else {
                    duration = 1;
                }
                
                // Update teks durasi di UI
                document.getElementById('daysCount').innerText = duration;
                
                // Hitung ulang total harga karena durasi berubah
                calculateAllTotal();
            }
            
            // Function untuk refresh availability via AJAX
            function refreshAvailability(dateStr) {
                console.log('Refreshing availability for date:', dateStr);
                
                fetch('{{ route("rent.check_availability") }}?date=' + dateStr)
                    .then(response => {
                        console.log('Response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Availability data:', data);
                        // Update availability UI untuk setiap equipment
                        data.forEach(item => {
                            console.log(`Updating equipment ${item.id}: available=${item.available}, is_available=${item.is_available}`);
                            const card = document.querySelector(`[data-equipment-id="${item.id}"]`);
                            if (card) {
                                const imageDiv = card.querySelector('[data-available-check]');
                                const badge = card.querySelector('[data-availability-badge]');
                                const statusText = card.querySelector('[data-available-text]');
                                
                                if (item.is_available) {
                                    imageDiv.classList.remove('opacity-60');
                                    if (badge) badge.style.display = 'none';
                                    if (statusText) statusText.innerHTML = '<span class="text-green-600 font-semibold">✓ Tersedia: ' + item.available + ' unit</span>';
                                } else {
                                    imageDiv.classList.add('opacity-60');
                                    if (badge) badge.style.display = 'flex';
                                    if (statusText) statusText.innerHTML = '<span class="text-red-600 font-semibold">✗ Habis di tanggal ini</span>';
                                }
                                
                                // Disable/enable buttons
                                const btnsPanel = card.querySelector('[data-qty-controls]');
                                if (btnsPanel) {
                                    btnsPanel.style.pointerEvents = item.is_available ? 'auto' : 'none';
                                    btnsPanel.style.opacity = item.is_available ? '1' : '0.5';
                                }
                            } else {
                                console.warn('Card not found for equipment:', item.id);
                            }
                        });
                    })
                    .catch(err => console.error('Error fetching availability:', err));
            }
        });

        // --- 2. LOGIKA UPDATE QTY & HARGA ---
        // Fungsi ini dipanggil saat tombol + atau - diklik
        function updateQty(itemId, change, pricePerDay) {
            // Ambil elemen input hidden dan tampilan angka
            const inputEl = document.getElementById(`input-qty-${itemId}`);
            const displayEl = document.getElementById(`display-qty-${itemId}`);
            
            // Hitung nilai baru
            let currentQty = parseInt(inputEl.value) || 0;
            let newQty = currentQty + change;

            // Mencegah minus
            if (newQty < 0) newQty = 0;

            // Update ke HTML (Tampilan & Input Hidden)
            inputEl.value = newQty;
            displayEl.innerText = newQty;

            // Hitung subtotal barang ini (Harga x Jumlah)
            itemSubtotals[itemId] = newQty * pricePerDay;

            // Hitung ulang Grand Total
            calculateAllTotal();
        }

        function calculateAllTotal() {
            let totalPerDay = 0;

            // Jumlahkan semua subtotal barang
            for (const key in itemSubtotals) {
                totalPerDay += itemSubtotals[key];
            }

            // Total Akhir = (Total Barang per Hari) x (Durasi Hari)
            const grandTotal = totalPerDay * duration;

            // Format Rupiah
            const formattedMoney = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(grandTotal);

            // Update teks Total Price
            document.getElementById('totalPrice').innerText = formattedMoney;
        }
    </script>
@endpush