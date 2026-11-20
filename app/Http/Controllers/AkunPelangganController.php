<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunPelangganController extends Controller
{
    public function index()
    {
        // Mengambil data pelanggan yang memiliki relasi akun (user)
        $pelanggans = Pelanggan::whereNotNull('user_id')->with('user')->latest()->get();
        return view('akun_pelanggan.index', compact('pelanggans'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8', // Boleh kosong jika tidak ingin ganti password
        ]);

        // Cari akun User berdasarkan ID
        $user = User::findOrFail($id);
        $user->email = $request->email;
        
        // Jika form password diisi, maka update passwordnya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return back()->with('success', 'Email / Password pelanggan berhasil diperbarui!');
    }
}