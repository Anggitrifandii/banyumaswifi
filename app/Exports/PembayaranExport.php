<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PembayaranExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pembayaran::with('pelanggan')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pelanggan',
            'Bulan Tagihan',
            'Tanggal Bayar',
            'Jumlah Bayar',
            'Status Pembayaran'
        ];
    }

    public function map($pembayaran): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $pembayaran->pelanggan->nama ?? 'Data Terhapus',
            $pembayaran->bulan_tagihan,
            \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d-m-Y'),
            $pembayaran->jumlah_bayar,
            ucfirst(str_replace('_', ' ', $pembayaran->status_pembayaran))
        ];
    }
}