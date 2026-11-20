<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::latest()->get();
        return view('inventaris.index', compact('inventaris'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_perangkat' => 'required|string|max:255',
            'kategori' => 'required|string',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        Inventaris::create($validatedData);

        return back()->with('success', 'Perangkat berhasil ditambahkan ke inventaris!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jenis_update' => 'required|in:tambah,kurang,set',
            'jumlah' => 'required|integer|min:0',
            'kondisi' => 'required|string',
        ]);

        $barang = Inventaris::findOrFail($id);
        
        $stokBaru = $barang->stok;
        if ($request->jenis_update == 'tambah') {
            $stokBaru += $request->jumlah;
            $pesan = 'Stok masuk berhasil ditambahkan!';
        } elseif ($request->jenis_update == 'kurang') {
            $stokBaru -= $request->jumlah;
            if ($stokBaru < 0) $stokBaru = 0;
            $pesan = 'Stok keluar berhasil dicatat!';
        } else {
            $stokBaru = $request->jumlah;
            $pesan = 'Data inventaris berhasil diperbarui!';
        }

        $barang->update([
            'stok' => $stokBaru,
            'kondisi' => $request->kondisi,
        ]);

        return back()->with('success', $pesan);
    }

    public function destroy($id)
    {
        $barang = Inventaris::findOrFail($id);
        $barang->delete();
        
        return back()->with('success', 'Perangkat berhasil dihapus dari sistem!');
    }
}