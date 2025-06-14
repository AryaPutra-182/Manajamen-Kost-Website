<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class publicController extends Controller
{
    /**
     * Display the public home page.
     */
    public function index()
    {
        $kosts  = Kost::where('status_ketersediaan', 'Tersedia')->latest()->paginate(10);
        return view('public.index' , compact('kosts'));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('public.about');
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('public.contact');
    }
    public function show(Kost $kost)
    {
        return view('public.show', compact('kost'));
    }
}
