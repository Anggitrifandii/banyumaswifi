<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenStafController extends Controller
{
    public function index()
    {
        // Boss hanya melihat daftar orang yang jabatannya 'admin'
        $stafs = User::where('role', 'admin')->latest()->get();
        return view('boss.staf.index', compact('stafs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Paksa role menjadi admin
        ]);

        return back()->with('success', 'Akun Admin/Staf baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $staf = User::findOrFail($id);
        $staf->name = $request->name;
        $staf->email = $request->email;
        
        // Hanya update password jika form password diisi
        if ($request->filled('password')) {
            $staf->password = Hash::make($request->password);
        }
        
        $staf->save();

        return back()->with('success', 'Data Admin/Staf berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Akses Admin/Staf berhasil dicabut dan dihapus.');
    }
}