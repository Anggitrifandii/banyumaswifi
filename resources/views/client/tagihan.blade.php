<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Informasi Tagihan & Riwayat Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm shadow-slate-200/50 flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 text-white flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold mb-1">Tagihan Bulan Ini</h3>
                        <p class="text-blue-100 text-sm">Periode: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-100 text-sm font-semibold uppercase tracking-wider mb-1">Status</p>
                        
                        @if($profil && $profil->status_tagihan_bulan_ini == 'Lunas')
                            <span class="px-4 py-1.5 bg-green-400 text-green-900 rounded-full text-sm font-extrabold shadow-md">LUNAS</span>
                        @elseif($profil && $profil->status_tagihan_bulan_ini == 'Belum Bayar')
                            <span class="px-4 py-1.5 bg-yellow-400 text-yellow-900 rounded-full text-sm font-extrabold shadow-md">BELUM BAYAR</span>
                        @elseif($profil && $profil->status_tagihan_bulan_ini == 'Menunggak')
                            <span class="px-4 py-1.5 bg-red-500 text-white rounded-full text-sm font-extrabold shadow-md animate-pulse">MENUNGGAK</span>
                        @elseif($profil && $profil->status_tagihan_bulan_ini == 'Belum Aktif')
                            <span class="px-4 py-1.5 bg-gray-400 text-white rounded-full text-sm font-extrabold shadow-md">BELUM AKTIF</span>
                        @else
                            <span class="px-4 py-1.5 bg-gray-800 text-white rounded-full text-sm font-extrabold shadow-md">NONAKTIF / PROFIL BELUM LENGKAP</span>
                        @endif
                    </div>
                </div>

                <div class="p-8">
                    @if($profil && $profil->status == 'aktif')
                        <div class="flex flex-col md:flex-row justify-between items-center bg-slate-50 p-6 rounded-xl border border-slate-200 mb-8">
                            <div class="mb-4 md:mb-0 text-center md:text-left">
                                <p class="text-sm text-slate-500 font-semibold uppercase tracking-wide">Total Harus Dibayar</p>
                                <p class="text-4xl font-black text-slate-800 mt-1">Rp {{ number_format($profil->paket?->harga ?? 0, 0, ',', '.') }}</p>
                            </div>
                            
                            <div class="text-center md:text-right">
                                @if($profil->status_tagihan_bulan_ini == 'Menunggak' || $profil->status_tagihan_bulan_ini == 'Belum Bayar')
                                    <p class="text-sm text-red-600 font-bold uppercase tracking-wide">Telah Menunggak Sejak</p>
                                    <p class="text-xl font-bold text-red-600 mt-1">{{ \Carbon\Carbon::parse($profil->tanggal_jatuh_tempo)->translatedFormat('d F Y') }}</p>
                                @else
                                    <p class="text-sm text-slate-500 font-semibold uppercase tracking-wide">Pembayaran Berikutnya</p>
                                    <p class="text-xl font-bold text-[#1a44a6] mt-1">{{ \Carbon\Carbon::parse($profil->tanggal_jatuh_tempo)->translatedFormat('d F Y') }}</p>
                                @endif
                            </div>
                        </div>

                        @if($profil->status_tagihan_bulan_ini != 'Lunas')
                            <div class="bg-white border-2 border-blue-100 rounded-xl p-6 shadow-sm shadow-slate-200/50 text-center">
                                <p class="text-slate-500 text-sm mb-6">Sistem kami mendukung berbagai metode pembayaran. Klik tombol di bawah untuk memilih metode bayar.</p>
                                
                                <a href="{{ route('client.pembayaran.metode') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-lg py-4 rounded-xl shadow-lg shadow-blue-500/30 transform transition hover:-translate-y-1">
                                    Pilih Metode Pembayaran
                                </a>
                            </div>
                        @endif

                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200">
                <div class="p-6 text-slate-800">
                    <h3 class="text-lg font-bold text-[#1a44a6] mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Riwayat Transaksi Terakhir
                    </h3>

                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="min-w-full bg-white">
                            <thead class="bg-slate-50 border-b border-slate-200 text-left text-xs uppercase font-semibold text-slate-500 tracking-wider">
                                <tr>
                                    <th class="py-4 px-6">Bulan Tagihan</th>
                                    <th class="py-4 px-6">Tanggal Bayar</th>
                                    <th class="py-4 px-6">Nominal (Rp)</th>
                                    <th class="py-4 px-6 text-center">Status</th>
                                    <th class="py-4 px-6 text-center">Struk / Invoice</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-slate-100">
                                @forelse($riwayat as $bayar)
                                <tr class="hover:bg-blue-50/50 transition">
                                    <td class="py-4 px-6 font-bold text-[#1a44a6]">{{ $bayar->bulan_tagihan }}</td>
                                    <td class="py-4 px-6 text-slate-600">{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->translatedFormat('d F Y') }}</td>
                                    <td class="py-4 px-6 font-black text-green-600">{{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td class="py-4 px-6 text-center">
                                        @if(strtolower($bayar->status_pembayaran) == 'lunas')
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-black uppercase">LUNAS</span>
                                        @elseif(strtolower($bayar->status_pembayaran) == 'menunggu')
                                            <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-black uppercase animate-pulse">MENUNGGU KONFIRMASI</span>
                                        @elseif(strtolower($bayar->status_pembayaran) == 'ditolak')
                                            <div class="flex flex-col items-center gap-1">
                                                <span class="px-3 py-1 bg-red-600 text-white rounded-full text-xs font-black uppercase">DITOLAK</span>
                                                @if($bayar->keterangan_tolak)
                                                    <span class="text-[10px] text-red-600 font-bold max-w-xs text-center break-words italic">*{{ $bayar->keterangan_tolak }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-black uppercase">BELUM LUNAS</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        @if(strtolower($bayar->status_pembayaran) == 'lunas')
                                            <a href="{{ route('client.cetak', $bayar->id) }}" target="_blank" class="inline-flex items-center bg-gray-800 hover:bg-black text-white text-xs font-bold py-2 px-4 rounded-lg shadow transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                                Cetak PDF
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400 italic font-medium">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="py-12 text-center text-slate-500 font-medium">Belum ada transaksi pembayaran.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
