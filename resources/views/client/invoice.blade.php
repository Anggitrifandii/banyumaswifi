<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - {{ $pembayaran->bulan_tagihan }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; background: #eee; padding: 20px; }
        .receipt { max-width: 350px; background: #fff; margin: 0 auto; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .header h2 { margin: 0; font-size: 20px; }
        .header p { margin: 5px 0 0; font-size: 12px; }
        .content { font-size: 14px; line-height: 1.6; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .content .row { display: flex; justify-content: space-between; }
        .footer { text-align: center; font-size: 12px; font-weight: bold; }
        @media print { body { background: #fff; padding: 0; } .receipt { box-shadow: none; max-width: 100%; } }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt">
        <div class="header">
            <h2>BANYUMAS WIFI</h2>
            <p>Bukti Pembayaran Layanan Internet</p>
        </div>
        
        <div class="content">
            <div class="row">
                <span>No. Transaksi:</span>
                <span>#TRX-{{ str_pad($pembayaran->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="row">
                <span>Tgl Bayar:</span>
                <span>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y') }}</span>
            </div>
            <div class="row">
                <span>Nama:</span>
                <span>{{ $pembayaran->pelanggan->nama }}</span>
            </div>
            <div class="row">
                <span>Paket:</span>
                <span>{{ $pembayaran->pelanggan->paket->nama_paket }}</span>
            </div>
            <div class="row">
                <span>Periode:</span>
                <span>{{ $pembayaran->bulan_tagihan }}</span>
            </div>
            <br>
            <div class="row" style="font-weight: bold; font-size: 16px;">
                <span>TOTAL:</span>
                <span>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
            </div>
            <div class="row">
                <span>Status:</span>
                <span>LUNAS</span>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih atas pembayaran Anda.</p>
            <p>-- Layanan Pelanggan LDP --</p>
        </div>
    </div>
</body>
</html>