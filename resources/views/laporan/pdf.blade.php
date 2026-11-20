<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran BanyumasWifi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 20px; }
        .header p { margin: 5px 0 0 0; font-size: 12px; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <div class="header">
        @php
            $pengaturan = \Illuminate\Support\Facades\Schema::hasTable('pengaturans') ? \App\Models\Pengaturan::first() : null;
        @endphp
        <h1>{{ $pengaturan && $pengaturan->nama_perusahaan ? strtoupper($pengaturan->nama_perusahaan) : 'BANYUMASWIFI BY LDP' }}</h1>
        <p>{{ $pengaturan && $pengaturan->alamat ? $pengaturan->alamat : 'Laporan Keuangan dan Data Pembayaran Pelanggan' }}</p>
        @if($pengaturan && $pengaturan->no_telp)
            <p>Telp/WA: {{ $pengaturan->no_telp }}</p>
        @endif
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama Pelanggan</th>
                <th>Bulan Tagihan</th>
                <th class="text-center">Tgl Bayar</th>
                <th class="text-right">Jumlah Bayar (Rp)</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($pembayarans as $index => $bayar)
                @php $total += $bayar->jumlah_bayar; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $bayar->pelanggan->nama ?? 'Data Dihapus' }}</td>
                    <td>{{ $bayar->bulan_tagihan }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d-m-Y') }}</td>
                    <td class="text-right">{{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                    <td class="text-center">{{ ucfirst(str_replace('_', ' ', $bayar->status_pembayaran)) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data transaksi</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Pendapatan:</th>
                <th class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <br><br>
    <table style="width: 100%; border: none; margin-top: 20px;">
        <tr>
            <td style="width: 60%; border: none;"></td>
            <td style="width: 40%; text-align: center; border: none;">
                Banyumas, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                Administrator<br><br><br><br><br>
                <strong>( ........................................ )</strong>
            </td>
        </tr>
    </table>

</body>
</html>