<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with('pelanggan.paket')->latest();
        
        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('bulan_tagihan', $request->bulan);
        }
        
        $pembayarans = $query->get();
        $bulan_list = Pembayaran::select('bulan_tagihan')->distinct()->orderBy('bulan_tagihan')->pluck('bulan_tagihan');
        
        return view('laporan.index', compact('pembayarans', 'bulan_list'));
    }

    public function exportPdf(Request $request)
    {
        $query = Pembayaran::with('pelanggan.paket')->latest();
        
        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('bulan_tagihan', $request->bulan);
        }
        
        $pembayarans = $query->get();
        
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.pdf', compact('pembayarans'));
            return $pdf->download('Laporan_Pembayaran_BanyumasWiFi.pdf');
        }
        
        return view('laporan.pdf', compact('pembayarans'));
    }

    public function exportExcel(Request $request)
    {
        $query = Pembayaran::with('pelanggan.paket')->latest();
        
        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('bulan_tagihan', $request->bulan);
        }
        
        $pembayarans = $query->get();
        
        return view('laporan.excel', compact('pembayarans'));
    }
}