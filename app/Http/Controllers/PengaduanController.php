<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with('pelanggan')->latest()->get();
        return view('pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::where('status', 'aktif')->get();
        return view('pengaduan.create', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'jenis_gangguan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tanggal_lapor' => 'required|date',
        ]);
        
        $data = $request->all();
        $data['status_tiket'] = 'Menunggu Teknisi';

        Pengaduan::create($data);

        return redirect()->route('pengaduan.index')->with('success', 'Tiket pengaduan berhasil dibuat.');
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status_tiket' => 'required|in:Menunggu Teknisi,Sedang Diperbaiki,Selesai',
            'balasan_admin' => 'nullable|string', // Validasi untuk balasan chat
        ]);

        $pengaduan->update([
            'status_tiket' => $request->status_tiket,
            'balasan_admin' => $request->balasan_admin,
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Status tiket dan pesan balasan berhasil dikirim.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Tiket berhasil dihapus.');
    }
}