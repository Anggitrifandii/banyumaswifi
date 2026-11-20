<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Tugas - {{ $tugas->teknisi->nama ?? 'Teknisi' }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; color: #333; margin: 30px; }
        .header { text-align: center; border-bottom: 3px solid #1e3a8a; padding-bottom: 10px; margin-bottom: 30px; position: relative; }
        .header h1 { margin: 0; color: #1e3a8a; font-size: 28px; font-weight: 900; letter-spacing: 1px; }
        .header p { margin: 2px 0; font-size: 12px; color: #555; }
        .title { text-align: center; font-weight: bold; text-decoration: underline; font-size: 18px; margin-bottom: 5px; }
        .subtitle { text-align: center; font-size: 12px; margin-bottom: 30px; color: #666; }
        .content { margin-bottom: 30px; }
        .content p { margin: 5px 0; }
        .table-info { width: 100%; margin-top: 15px; border-collapse: collapse; }
        .table-info th, .table-info td { padding: 10px; border: 1px solid #ddd; text-align: left; vertical-align: top; }
        .table-info th { background-color: #f3f4f6; width: 30%; font-weight: bold; color: #1e3a8a; }
        .footer { width: 100%; margin-top: 50px; text-align: center; font-size: 14px; }
        .signature-box { float: right; width: 35%; text-align: center; }
        .signature-box-left { float: left; width: 35%; text-align: center; }
        .name-line { font-weight: bold; text-decoration: underline; margin-top: 80px; }
        .clear { clear: both; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; background-color: #1e3a8a; color: white; }
    </style>
</head>
<body>

    <div class="header">
        <h1>BANYUMAS WIFI</h1>
        <p>Jl. Jend. Sudirman No. 123, Purbalingga, Jawa Tengah</p>
        <p>Email: cs@banyumaswifi.com | Telp/WA: 0812-3456-7890</p>
    </div>

    <div class="title">SURAT PERINTAH TUGAS</div>
    <div class="subtitle">Nomor: SPT/BW/{{ date('Y/m/d', strtotime($tugas->created_at)) }}/{{ sprintf("%04d", $tugas->id) }}</div>

    <div class="content">
        <p>Dengan hormat,</p>
        <p>Pimpinan Manajemen BanyumasWiFi dengan ini memberikan perintah tugas kerja kepada personel berikut:</p>
        
        <table class="table-info" style="margin-bottom: 25px;">
            <tr>
                <th>Nama Teknisi</th>
                <td><strong>{{ $tugas->teknisi->nama ?? 'Data Teknisi Dihapus' }}</strong></td>
            </tr>
            <tr>
                <th>Kontak / Telp</th>
                <td>{{ $tugas->teknisi->no_telp ?? '-' }}</td>
            </tr>
        </table>

        <p>Untuk melaksanakan pekerjaan operasional lapangan dengan rincian penugasan sebagai berikut:</p>

        <table class="table-info">
            <tr>
                <th>Instruksi Tugas</th>
                <td style="font-weight: bold;">{{ $tugas->judul_tugas }}</td>
            </tr>
            <tr>
                <th>Jenis Pekerjaan</th>
                <td><span class="badge">{{ $tugas->jenis_tugas }}</span></td>
            </tr>
            <tr>
                <th>Jadwal Kunjungan</th>
                <td>{{ \Carbon\Carbon::parse($tugas->jadwal_kunjungan)->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <th>Lokasi / Alamat</th>
                <td>{{ $tugas->lokasi_alamat }}</td>
            </tr>
            <tr>
                <th>Catatan Tambahan</th>
                <td>{{ $tugas->catatan ?? 'Tidak ada catatan khusus.' }}</td>
            </tr>
        </table>

        <p style="margin-top: 25px;">Demikian surat perintah tugas ini dibuat agar dapat dilaksanakan dengan penuh tanggung jawab sesuai dengan Standar Operasional Prosedur (SOP) perusahaan.</p>
    </div>

    <div class="footer">
        <div class="signature-box-left">
            <p>Diterima Oleh,</p>
            <p><strong>Teknisi Lapangan</strong></p>
            <div class="name-line">{{ $tugas->teknisi->nama ?? '..........................' }}</div>
        </div>
        <div class="signature-box">
            <p>Purbalingga, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p><strong>Mengetahui / Admin,</strong></p>
            <div class="name-line">{{ Auth::user()->name }}</div>
        </div>
        <div class="clear"></div>
    </div>

</body>
</html>