<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::latest()->get();
        return view('paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('paket.create');
    }

    public function store(Request $request)
    {
        // Menghapus titik agar inputan "250.000" bisa dibaca sistem sebagai angka
        $request->merge([
            'harga' => str_replace('.', '', $request->harga),
        ]);

        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kecepatan' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
        ]);

        Paket::create($request->all());

        return redirect()->route('paket.index')->with('success', 'Paket internet berhasil ditambahkan.');
    }

    public function edit(Paket $paket)
    {
        return view('paket.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $request->merge([
            'harga' => str_replace('.', '', $request->harga),
        ]);

        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kecepatan' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
        ]);

        $paket->update($request->all());

        return redirect()->route('paket.index')->with('success', 'Paket internet berhasil diperbarui.');
    }

    public function destroy(Paket $paket)
    {
        if ($paket->pelanggans()->count() > 0) {
            return redirect()->route('paket.index')->with('error', 'Gagal! Paket masih digunakan pelanggan.');
        }
        $paket->delete();
        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus.');
    }
}