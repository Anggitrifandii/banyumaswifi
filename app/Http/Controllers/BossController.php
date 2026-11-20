<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Paket;
use App\Models\Pengaduan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class BossController extends Controller
{
    public function dashboard()
    {
        // 1. Ambil data statistik dasar yang masih ada di database
        $totalPelanggan = Pelanggan::count();
        $pelangganAktif = Pelanggan::where('status', 'aktif')->count();
        $totalPaket = Paket::count();
        
        // 2. Hitung total omzet pendapatan dari transaksi yang LUNAS
        $totalPendapatan = Pembayaran::where('status_pembayaran', 'lunas')->sum('jumlah_bayar');
        
        // 3. Hitung jumlah komplain pelanggan yang belum selesai
        $tiketTerbuka = Pengaduan::where('status_tiket', '!=', 'Selesai')->count();
        
        // 4. Ambil 5 riwayat aktivitas CCTV sistem terbaru untuk dipantau Boss
        $riwayatLog = LogAktivitas::with('user')->latest()->take(5)->get();

        return view('boss.dashboard', compact(
            'totalPelanggan', 
            'pelangganAktif', 
            'totalPaket', 
            'totalPendapatan', 
            'tiketTerbuka',
            'riwayatLog'
        ));
    }
}