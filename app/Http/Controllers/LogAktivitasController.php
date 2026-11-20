<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index()
    {
        // Ambil 50 log terbaru untuk ditampilkan
        $logs = LogAktivitas::with('user')->latest()->take(50)->get();
        return view('boss.log.index', compact('logs'));
    }

    // Fungsi Hapus 1 Log
    public function destroy($id)
    {
        LogAktivitas::findOrFail($id)->delete();
        return back()->with('success', 'Catatan log aktivitas berhasil dihapus.');
    }

    // Fungsi Hapus SEMUA Log (Sapu Bersih)
    public function clearAll()
    {
        // Menggunakan delete() agar tidak diblokir oleh sistem Foreign Key MySQL
        LogAktivitas::query()->delete(); 
        return back()->with('success', 'Seluruh riwayat aktivitas sistem telah dibersihkan secara permanen!');
    }
}