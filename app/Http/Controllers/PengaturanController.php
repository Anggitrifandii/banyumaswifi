<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        // Otomatis buat data jika tabel pengaturan masih kosong
        $pengaturan = Pengaturan::firstOrCreate(
            ['id' => 1],
            [
                'nama_aplikasi' => 'BanyumasWiFi',
                'nama_perusahaan' => 'Banyumas LDP',
                'no_telp' => '-',
                'alamat' => '-',
                'pesan_sambutan' => 'Selamat datang di portal pelanggan BanyumasWiFi'
            ]
        );

        return view('pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'pesan_sambutan' => 'nullable|string',
        ]);

        $pengaturan = Pengaturan::first();
        $pengaturan->update($validatedData);

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui secara permanen!');
    }
}