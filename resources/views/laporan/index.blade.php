<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Laporan Keuangan & Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200">
                <div class="p-6 text-slate-800">
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                        <div>
                            <h3 class="text-lg font-bold text-[#1a44a6]">Data Seluruh Transaksi</h3>
                            <p class="text-xs text-slate-500 mt-1">* Baris teratas menunjukkan transaksi paling baru diproses.</p>
                        </div>
                        
                        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                            <!-- Filter Form -->
                            <form action="{{ url()->current() }}" method="GET" class="flex gap-2 w-full md:w-auto">
                                <select name="bulan" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-[#1a44a6] focus:border-[#1a44a6] block w-full p-2.5">
                                    <option value="">Semua Bulan</option>
                                    @foreach($bulan_list as $bln)
                                        <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="inline-flex items-center justify-center bg-[#1a44a6] hover:bg-blue-800 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                </button>
                                @if(request()->has('bulan') && request('bulan') != '')
                                    <a href="{{ url()->current() }}" class="inline-flex items-center justify-center bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-2.5 px-4 rounded-xl shadow-sm transition" title="Reset Filter">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </a>
                                @endif
                            </form>

                            <div class="flex gap-2">
                                <a href="{{ route('laporan.pdf', request()->query()) }}" class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm shadow-slate-200/50 transition">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"></path><path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"></path></svg>
                                    PDF
                                </a>
                                <a href="{{ route('laporan.excel', request()->query()) }}" class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm shadow-slate-200/50 transition">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd"></path></svg>
                                    Excel
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="min-w-full bg-white">
                            <thead class="bg-slate-50 border-b border-slate-200 text-left text-[11px] uppercase font-bold text-slate-500 tracking-widest">
                                <tr>
                                    <th class="py-4 px-6 w-16 text-center">#</th>
                                    <th class="py-4 px-6">Nama Pelanggan</th>
                                    <th class="py-4 px-6">Bulan Tagihan</th>
                                    <th class="py-4 px-6">Tgl Bayar</th>
                                    <th class="py-4 px-6">Jumlah</th>
                                    <th class="py-4 px-6 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-slate-50">
                                @forelse($pembayarans as $index => $bayar)
                                <tr class="hover:bg-blue-50/30 transition group {{ $index == 0 ? 'bg-blue-50/20' : '' }}">
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center">
                                            <svg class="w-4 h-4 text-blue-500 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-[#1a44a6]">{{ $bayar->pelanggan->nama ?? 'N/A' }}</span>
                                            @if($index == 0)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-black bg-blue-600 text-white uppercase tracking-tighter animate-pulse">Terbaru</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600">{{ $bayar->bulan_tagihan }}</td>
                                    <td class="py-4 px-6 text-slate-600">{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->translatedFormat('d M Y') }}</td>
                                    <td class="py-4 px-6 font-black text-slate-800">Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase">Lunas</span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="py-12 text-center text-slate-500">Belum ada transaksi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
