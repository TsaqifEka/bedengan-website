<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Booking;
use App\Models\Rent;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role->name !== 'Admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman Admin!');
        }

        //get tanggal
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $bookingQuery = Booking::where('status', 'paid');
        $rentQuery = Rent::where('status', 'paid');

        // filter tanggal
        if ($startDate && $endDate) {
            $bookingQuery->whereBetween('visit_date', [$startDate, $endDate]);
            $rentQuery->whereBetween('start_date', [$startDate, $endDate]); // Sesuaikan nama kolom tanggal di tabel Rent
        }

        // go to get data
        $ticketsSold = $bookingQuery->sum('quantity');
        $totalRentals = $rentQuery->count();
        
        $revenueTickets = $bookingQuery->sum('total_price');
        $revenueRentals = $rentQuery->sum('total_price');
        $totalRevenue = $revenueTickets + $revenueRentals;

        $totalUser = User::count();

        return view('dashboard.index', compact(
            'totalUser', 
            'ticketsSold', 
            'totalRentals', 
            'totalRevenue',
            'startDate',
            'endDate'
        ));
    }
    
}
