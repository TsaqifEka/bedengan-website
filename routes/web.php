<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\MomentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\EquipmentController as AdminEquipmentController;
use App\Http\Controllers\Admin\RentController as AdminRentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\GalleryController;

Route::get('/', [HomeController::class, 'index'])->name('home');

//login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
//register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// tiket
Route::get('/ticket', [BookingController::class, 'index'])->name('booking.index');
Route::post('/ticket/store', [BookingController::class, 'store'])->name('booking.store');
// payment
Route::get('/payment/{id}', [BookingController::class, 'payment'])->name('booking.payment');
Route::post('/payment/{id}/submit', [BookingController::class, 'submitPayment'])->name('booking.submit_payment');
// riwayat tiket
Route::get('/booking-history', [BookingController::class, 'history'])->name('booking.history')->middleware('auth');

//rent
Route::get('/rent', [RentController::class, 'index'])->name('rent.index');

//moment 
Route::get('/moment', [ReviewController::class, 'index'])->name('moment.index');
Route::post('/moment', [ReviewController::class, 'store'])->name('moment.store')->middleware('auth');


//DASHBOARD
Route::middleware(['auth'])->group(function () {
    
    // Halaman Utama Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // crud admin
    Route::resource('users', UserController::class);

    //tiket
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/bookings/{id}/payment', [AdminBookingController::class, 'viewPayment'])->name('admin.bookings.view_payment');
    Route::post('/bookings/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.update_status');

    Route::get('/bookings/create', [AdminBookingController::class, 'create'])->name('admin.bookings.create');
    Route::post('/bookings/store', [AdminBookingController::class, 'store'])->name('admin.bookings.store');
    Route::get('/history', [BookingController::class, 'history'])->name('booking.history');

    //rent
    Route::get('/rent', [RentController::class, 'index'])->name('rent.index');
    Route::post('/rent', [RentController::class, 'store'])->name('rent.store');
    Route::get('/rent-payment/{id}', [RentController::class, 'payment'])->name('rent.payment');
    Route::post('/rent-payment/{id}/submit', [RentController::class, 'submitPayment'])->name('rent.submit_payment');
    Route::get('/rent/check-availability', [RentController::class, 'checkAvailability'])->name('rent.check_availability');

    //admin rentals
    Route::get('/admin-rentals', [AdminRentController::class, 'index'])->name('admin.rentals.index');
    Route::post('/admin-rentals/{id}/status', [AdminRentController::class, 'updateStatus'])->name('admin.rentals.update_status');

    //admin equipment CRUD
    Route::get('/admin-equipment', [AdminEquipmentController::class, 'index'])->name('admin.equipment.index');
    Route::get('/admin-equipment/create', [AdminEquipmentController::class, 'create'])->name('admin.equipment.create');
    Route::post('/admin-equipment', [AdminEquipmentController::class, 'store'])->name('admin.equipment.store');
    Route::get('/admin-equipment/{id}/edit', [AdminEquipmentController::class, 'edit'])->name('admin.equipment.edit');
    Route::put('/admin-equipment/{id}', [AdminEquipmentController::class, 'update'])->name('admin.equipment.update');
    Route::delete('/admin-equipment/{id}', [AdminEquipmentController::class, 'destroy'])->name('admin.equipment.destroy');
});


