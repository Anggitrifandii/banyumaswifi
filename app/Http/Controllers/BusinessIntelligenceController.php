<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Paket;
use Illuminate\Http\Request;

class BusinessIntelligenceController extends Controller
{
    public function index()
    {
        // Menghitung statistik murni finansial dan pelanggan yang masih aktif
        $totalKlien = Pelanggan::count();
        $omzetMurni = Pembayaran::where('status_pembayaran', 'lunas')->sum('jumlah_bayar');
        $rataRataTagihan = Paket::avg('harga') ?? 0;

        return view('boss.bi.index', compact('totalKlien', 'omzetMurni', 'rataRataTagihan'));
    }
}