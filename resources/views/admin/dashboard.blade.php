{{-- /resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

{{-- Mengatur judul halaman (ditampilkan di tab browser) --}}
@section('title', 'Dashboard Admin')

{{-- Mengatur judul konten halaman --}}
@section('content_header')
    <h1>Dashboard</h1>
@stop

{{-- Konten utama halaman --}}
@section('content')
    <p>Selamat datang di Panel Admin!</p>
    
    {{-- Contoh penggunaan widget "small box" dari AdminLTE --}}
    <div class="row">
        <div class="col-lg-3 col-6">
            {{-- Widget Total Pengguna --}}
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalUsers ?? '0' }}</h3>
                    <p>Total Pengguna</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            {{-- Widget Total Kost --}}
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalKosts ?? '0' }}</h3>
                    <p>Total Properti Kost</p>
                </div>
                <div class="icon">
                    <i class="fas fa-home"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
             {{-- Widget Booking Pending --}}
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pendingBookings ?? '0' }}</h3>
                    <p>Booking Pending</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@stop

{{-- Menambahkan CSS kustom jika diperlukan --}}
@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

{{-- Menambahkan JS kustom jika diperlukan --}}
@section('js')
    <script> console.log("Halaman Dashboard Admin"); </script>
@stop