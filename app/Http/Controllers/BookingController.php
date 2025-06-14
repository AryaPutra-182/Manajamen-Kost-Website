<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function history()
{
    $bookings = Booking::where('user_id', Auth::id())
                         ->with('kost') // Eager load data kost
                         ->latest()
                         ->paginate(10);
    return view('dashboard.booking-history', compact('bookings'));
}
}
