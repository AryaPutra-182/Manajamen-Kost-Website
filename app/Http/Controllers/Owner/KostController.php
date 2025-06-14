<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kosts = kost::where('user_id', auth()->id())->latest()->paginate(10);
        return view('owner.kost.index', compact('kosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.kost.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_ketersediaan' => 'required|in:Tersedia,Penuh',
        ]);

        $kost = new kost($request->all());
        $kost->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $kost->image = $request->file('image')->store('kost_images', 'public');
        }

        $kost->save();

        return redirect()->route('owner.kosts.index')->with('success', 'Kost created successfully.');
    }
   public function viewBookings()
{
    // Ambil semua booking untuk semua kost yang dimiliki oleh user ini
    $bookings = Booking::whereHas('kost', function ($query) {
        $query->where('user_id', Auth::id());
    })->with(['kost', 'tenant'])->latest()->paginate(10);

    return view('owner.bookings.index', compact('bookings'));
}
public function updateBookingStatus(Request $request, Booking $booking)
{
    // Pastikan owner hanya bisa mengubah status booking untuk kost miliknya
    if ($booking->kost->user_id !== Auth::id()) {
        abort(403);
    }

    $request->validate(['status' => 'required|in:approved,rejected']);
    $booking->status = $request->status;
    $booking->save();
    
    // Jika disetujui, ubah status ketersediaan kost menjadi Penuh
    if ($request->status == 'approved') {
        $booking->kost->status_ketersediaan = 'Penuh';
        $booking->kost->save();
    }

    return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
}

    /**
     * Display the specified resource.
     */
    public function show(kost $kost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kost $kost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kost $kost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kost $kost)
    {
        //
    }
}
