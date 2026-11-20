<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Keuangan_BanyumasWiFi_" . date('d-m-Y') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<table border="0">
    <tr>
        <td colspan="6" style="font-size: 16px; font-weight: bold; text-align: center;">REKAPITULASI TRANSAKSI PEMBAYARAN </td>
    </tr>
    <tr>
        <td colspan="6" style="font-size: 12px; text-align: center; color: #2563EB;">BANYUMAS WIFI BY LDP </td>
    </tr>
    <tr><td colspan="6"></td></tr>
</table>

<table border="1">
    <thead>
        <tr>
            <th style="background-color: #1e40af; color: #ffffff; font-weight: bold; text-align: center; width: 50px;"># </th>
            <th style="background-color: #1e40af; color: #ffffff; font-weight: bold; text-align: center; width: 200px;">NAMA PELANGGAN </th>
            <th style="background-color: #1e40af; color: #ffffff; font-weight: bold; text-align: center; width: 150px;">BULAN TAGIHAN </th>
            <th style="background-color: #1e40af; color: #ffffff; font-weight: bold; text-align: center; width: 150px;">TGL BAYAR </th>
            <th style="background-color: #1e40af; color: #ffffff; font-weight: bold; text-align: center; width: 150px;">NOMINAL (Rp) </th>
            <th style="background-color: #1e40af; color: #ffffff; font-weight: bold; text-align: center; width: 100px;">STATUS </th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach($pembayarans as $index => $bayar)
            @php $total += $bayar->jumlah_bayar; @endphp
            <tr>
                <td style="text-align: center;">{{ $index + 1 }} </td>
                <td style="text-align: left;">{{ $bayar->pelanggan->nama ?? 'N/A' }} </td>
                <td style="text-align: center;">{{ $bayar->bulan_tagihan }} </td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->translatedFormat('d-m-Y') }} </td>
                <td style="text-align: right;">{{ number_format($bayar->jumlah_bayar, 0, ',', '.') }} </td>
                <td style="text-align: center; color: #059669; font-weight: bold;">LUNAS </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="background-color: #f3f4f6; font-weight: bold; text-align: right;">TOTAL PENDAPATAN : </td>
            <td style="background-color: #d1fae5; font-weight: bold; text-align: right;">Rp {{ number_format($total, 0, ',', '.') }} </td>
            <td style="background-color: #f3f4f6;"></td>
        </tr>
    </tfoot>
</table>

<br>
<table border="0">
    <tr>
        <td colspan="4"></td>
        <td colspan="2" style="text-align: center;">Banyumas, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2" style="text-align: center;">Administrator</td>
    </tr>
    <tr>
        <td colspan="6" style="height: 60px;"></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2" style="text-align: center; font-weight: bold;">( ...................................... )</td>
    </tr>
</table>

</body>
</html>