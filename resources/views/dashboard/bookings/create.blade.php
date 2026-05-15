@extends('layouts.admin')

@section('title', 'Tambah Tiket Offline')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-700 mb-6 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-semibold text-gray-800">Input Tiket Offline (OTS)</h2>
            <p class="text-sm text-gray-500">Gunakan form ini untuk pengunjung yang membeli tiket di lokasi.</p>
        </div>
        
        <form action="{{ route('admin.bookings.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengunjung</label>
                <input type="text" name="name" required class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all" placeholder="Masukkan nama pengunjung">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP (Opsional)</label>
                    <input type="text" name="phone" class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all" placeholder="08xxx">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berkunjung</label>
                    <input type="date" name="visit_date" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="ticket_type" class="block text-gray-700 text-sm font-bold mb-2">Jenis Tiket</label>
                
                <select name="ticket_type" id="ticket_type" onchange="calculateTotal()" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">-- Pilih Tiket --</option>
                    <option value="10000" data-name="Day Pass">Day Pass - Rp 10.000</option>
                    <option value="25000" data-name="Camping Pass">Camping Pass - Rp 25.000</option>
                </select>
                <input type="hidden" name="ticket_price" id="ticket_price" value="">
            </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Orang</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" oninput="calculateTotal()" required class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                </div>
            </div>

            <div class="bg-green-50 rounded-xl p-4 border border-green-100 flex justify-between items-center">
                <span class="text-green-800 font-medium">Total Tagihan:</span>
                <span id="total_display" class="text-2xl font-bold text-green-700">Rp 0</span>
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl shadow-lg shadow-green-500/30 transition-all transform hover:-translate-y-0.5">
                Simpan Transaksi & Cetak
            </button>
        </form>
    </div>
</div>

<script>
    function calculateTotal() {
        const selectElement = document.getElementById('ticket_type');
        const price = selectElement.value;
        const qty = document.getElementById('quantity').value;
        
        // Set hidden input untuk ticket_price
        document.getElementById('ticket_price').value = price;
        
        if (!price || !qty) {
            document.getElementById('total_display').innerText = 'Rp 0';
            return;
        }
        
        const total = price * qty;
        
        // Format Rupiah
        const formatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(total);
        
        document.getElementById('total_display').innerText = formatted;
    }
</script>
@endsection