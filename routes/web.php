<?php

use Illuminate\Support\Facades\Route;

// Controller untuk halaman publik
use App\Http\Controllers\PublicController;

// Controller untuk fitur yang memerlukan login
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;

// Controller untuk role 'owner'
use App\Http\Controllers\Owner\KostController; // <-- Diperbaiki ke folder Owner

// Controller untuk role 'admin'
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE PUBLIK (Bisa diakses semua orang) ==
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/kost/{kost}', [PublicController::class, 'show'])->name('kost.show');


// == RUTE YANG MEMERLUKAN LOGIN (Semua Role) ==
Route::middleware(['auth', 'verified'])->group(function () {

    // Rute dashboard default dari Breeze
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute booking
    Route::post('/booking/{kost}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/my-bookings', [BookingController::class, 'history'])->name('booking.history');

});


// == RUTE KHUSUS UNTUK ROLE 'OWNER' ==
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::resource('kosts', KostController::class);
});


// == RUTE KHUSUS UNTUK ROLE 'ADMIN' ==
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class);
});


// File rute autentikasi dari Breeze
require __DIR__.'/auth.php';