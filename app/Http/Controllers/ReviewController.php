<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        // 1. Ambil semua review, urutkan dari yang terbaru
        $reviews = Review::with('user')->latest()->get();

        // 2. Hitung Statistik untuk ditampilkan di kartu atas
        $totalReviews = $reviews->count();
        $avgRating = $totalReviews > 0 ? number_format($reviews->avg('rating'), 1) : 0;
        $fiveStarCount = $reviews->where('rating', 5)->count();

        return view('page.moment', compact('reviews', 'totalReviews', 'avgRating', 'fiveStarCount'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        // Simpan ke database
        Review::create([
            'user_id' => Auth::id(), // Pastikan user sudah login
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Thank you for sharing your moment!');
    }
}