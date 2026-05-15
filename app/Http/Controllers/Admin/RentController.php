<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    // Menampilkan daftar rental
    public function index()
    {
        $rentals = Rent::latest()->get();
        return view('dashboard.rentals.index', compact('rentals'));
    }

    // Update status (Acc/Reject)
    public function updateStatus(Request $request, $id)
    {
        $rental = Rent::findOrFail($id);
        $rental->status = $request->status; // 'paid' atau 'failed'
        $rental->save();

        return redirect()->back()->with('success', 'Status rental berhasil diperbarui!');
    }
}
