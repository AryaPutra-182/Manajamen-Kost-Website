<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kost;
use App\Models\Booking;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     */
    public function index()
    {
        // Mengambil data statistik dari database
        $totalUsers = User::count();
        $totalKosts = Kost::count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();

        // Mengirim data ke view dan menampilkannya
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalKosts',
            'totalBookings',
            'pendingBookings'
        ));
    }
}