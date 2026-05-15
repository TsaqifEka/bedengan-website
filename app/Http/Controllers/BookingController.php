<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // 1. Menampilkan Halaman Form Tiket
    public function index() {
        return view('page.ticket'); // Sesuaikan dengan nama file blade tiket kamu
    }

    // 2. Proses Simpan Data (Saat tombol Continue diklik)
    public function store(Request $request) {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'visit_date' => 'required',
            'ticketType' => 'required', // name di radio button
            'quantity' => 'required|integer|min:1',
        ]);

        // Hitung Total Secara Backend (Lebih aman daripada ambil dari HTML)
        $totalPrice = $request->ticketType * $request->quantity;

        // Simpan ke Database
        $booking = Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'visit_date' => $request->visit_date, // Pastikan format tanggal YYYY-MM-DD
            'ticket_price' => $request->ticketType,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'unpaid',
        ]);

        // Redirect ke halaman payment dengan membawa ID booking
        return redirect()->route('booking.payment', ['id' => $booking->id]);
    }

    // 3. Menampilkan Halaman Payment (Logic nyusul)
    public function payment($id) {
        $booking = Booking::findOrFail($id);
        return view('page.payment', compact('booking')); // Kirim data booking ke view payment
    }

    public function submitPayment(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Maks 5MB
        ]);

        // 2. Cari Data Booking
        $booking = Booking::findOrFail($id);

        // 3. Proses Upload Gambar
        if ($request->hasFile('payment_proof')) {
            // Simpan gambar di folder 'public/payment_proofs'
            $imageName = time() . '.' . $request->payment_proof->extension();
            $request->payment_proof->move(public_path('payment_proofs'), $imageName);
            
            // (Opsional) Simpan nama file ke database jika kamu punya kolom 'payment_proof'
            $booking->payment_proof = $imageName;
        }

        // 4. Update Status Booking
        $booking->status = 'waiting_verification'; // Status berubah jadi menunggu verifikasi admin
        $booking->save();

        // 5. Redirect ke halaman Sukses (Belum dibuat, nanti kita buat)
        return view('page.success', compact('booking'));
    }
    public function history()
    {
        // Ambil semua booking berdasarkan email user yang login
        $bookings = Booking::where('email', auth()->user()->email)->get();

        return view('page.history-tiket', compact('bookings'));
    }
}