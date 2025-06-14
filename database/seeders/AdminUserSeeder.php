<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- 1. Import model User
use Illuminate\Support\Facades\Hash; // <-- 2. Import Hash untuk enkripsi password

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3. Kode untuk membuat user admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            // Gunakan Hash::make untuk mengenkripsi password dengan aman
            'password' => Hash::make('password123'),
            'email_verified_at' => now(), // Anggap email sudah terverifikasi
            // Ini bagian terpenting, menetapkan peran sebagai 'admin'
            'role' => 'admin',
        ]);
    }
}