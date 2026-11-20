<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeknisiController extends Controller
{
    public function index()
    {
        $teknisis = Teknisi::latest()->get();
        return view('data_teknisi.index', compact('teknisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|unique:teknisis,email',
        ]);

        Teknisi::create($request->all());

        LogAktivitas::create(['user_id' => Auth::id(), 'modul' => 'Master Data', 'aksi' => 'Tambah Teknisi', 'keterangan' => 'Mendaftarkan teknisi baru: ' . $request->nama]);
        return back()->with('success', 'Data Teknisi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|unique:teknisis,email,' . $id,
        ]);

        $teknisi = Teknisi::findOrFail($id);
        $teknisi->update($request->all());

        LogAktivitas::create(['user_id' => Auth::id(), 'modul' => 'Master Data', 'aksi' => 'Update Teknisi', 'keterangan' => 'Memperbarui data teknisi: ' . $request->nama]);
        return back()->with('success', 'Data Teknisi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $teknisi = Teknisi::findOrFail($id);
        $nama = $teknisi->nama;
        $teknisi->delete();

        LogAktivitas::create(['user_id' => Auth::id(), 'modul' => 'Master Data', 'aksi' => 'Hapus Teknisi', 'keterangan' => 'Menghapus teknisi: ' . $nama]);
        return back()->with('success', 'Data Teknisi berhasil dihapus!');
    }
}