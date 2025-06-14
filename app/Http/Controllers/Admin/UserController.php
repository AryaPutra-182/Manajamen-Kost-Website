<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna. (READ)
     */
    public function index()
    {
        $users = User::latest()->paginate(10); // Ambil 10 user terbaru
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk mengedit data pengguna.
     */
    public function edit(User $user)
    {
        // Laravel otomatis akan mencari user berdasarkan ID dari URL
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna di database. (UPDATE)
     */
    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:admin,owner,user', // Pastikan role valid
        ]);

        // Update data user
        $user->name = $request->name;
        $user->role = $request->role;
        $user->save();

        // Redirect kembali ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna dari database. (DELETE)
     */
    public function destroy(User $user)
    {
        // Tambahkan proteksi agar admin tidak bisa menghapus diri sendiri
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    // Method create() dan store() bisa dikosongkan untuk saat ini,
    // karena kita asumsikan user mendaftar lewat halaman registrasi utama.
}