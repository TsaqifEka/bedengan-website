<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Models\Booking; // Jangan lupa panggil Model Booking
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Menampilkan daftar booking
    public function index()
    {
        // Ambil data terbaru dari database
        $bookings = Booking::latest()->get();
        
        // Kirim ke view (sesuaikan nama folder view admin kamu)
        return view('dashboard.bookings.index', compact('bookings'));
    }

    // Update status (Acc/Reject)
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status; // 'paid' atau 'failed'
        $booking->save();

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui!');
    }
    public function create()
    {
        return view('dashboard.bookings.create');
    }

    /** 
     * Menyimpan Data Tiket Offline
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20', // Boleh kosong kalau malas isi
            'visit_date' => 'required|date',
            'ticket_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        // 2. Hitung Total
        $totalPrice = $request->ticket_price * $request->quantity;

        // 3. Simpan ke Database
        Booking::create([
            'name' => $request->name,
            'email' => 'offline@bedengan.com', // Email dummy penanda offline
            'phone' => $request->phone ?? '-',
            'visit_date' => $request->visit_date,
            'ticket_price' => $request->ticket_price,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'paid', // LANGSUNG LUNAS karena bayar tunai
            'payment_method' => 'offline', // (Opsional) jika ada kolom ini
            'payment_proof' => null, // Tidak butuh bukti transfer
        ]);

        // 4. Redirect
        return redirect()->route('admin.bookings.index')->with('success', 'Tiket offline berhasil ditambahkan!');
    }
        // Menampilkan gambar bukti pembayaran
    public function viewPayment($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Cek apakah ada bukti pembayaran
        if (!$booking->payment_proof) {
            abort(404, 'Bukti pembayaran tidak ditemukan');
        }
        
        // Path file
        $filePath = public_path('payment_proofs/' . $booking->payment_proof);
        
        // Cek apakah file ada
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        
        // Tampilkan file
        return response()->file($filePath);
    }
}