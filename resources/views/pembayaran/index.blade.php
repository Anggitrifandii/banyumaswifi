<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Data Pembayaran Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-lg border border-slate-200">
                <div class="p-6 text-slate-800">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-700">Riwayat Pembayaran & Verifikasi</h3>
                        <a href="{{ route('pembayaran.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition-colors">
                            + Input Pembayaran
                        </a>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-slate-200 shadow-sm shadow-slate-200/50">
                        <table class="min-w-full bg-white">
                            <thead class="bg-slate-50 border-b border-slate-200 text-left text-xs uppercase font-semibold text-slate-600">
                                <tr>
                                    <th class="py-4 px-6">No</th>
                                    <th class="py-4 px-6">Nama Pelanggan</th>
                                    <th class="py-4 px-6">Bulan Tagihan</th>
                                    <th class="py-4 px-6">Tgl Bayar</th>
                                    <th class="py-4 px-6">Jumlah</th>
                                    <th class="py-4 px-6 text-center">Bukti Transfer</th>
                                    <th class="py-4 px-6 text-center">Status</th>
                                    <th class="py-4 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                                @forelse($pembayarans as $index => $bayar)
                                <tr class="hover:bg-slate-50 transition duration-150">
                                    <td class="py-3 px-6">{{ $index + 1 }}</td>
                                    <td class="py-3 px-6 font-bold text-slate-800">{{ $bayar->pelanggan->nama ?? 'Data Terhapus' }}</td>
                                    <td class="py-3 px-6 font-semibold">{{ $bayar->bulan_tagihan }}</td>
                                    <td class="py-3 px-6">{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d M Y') }}</td>
                                    <td class="py-3 px-6 font-black text-green-600">Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                                    
                                    <td class="py-3 px-6 text-center">
                                        @if($bayar->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $bayar->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-full hover:bg-blue-100 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat Struk
                                            </a>
                                        @else
                                            <span class="text-xs text-slate-400 italic font-medium">Belum Ada Bukti</span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        @if(strtolower($bayar->status_pembayaran) == 'lunas')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-black uppercase tracking-wider rounded-full bg-green-100 text-green-800">
                                                LUNAS
                                            </span>
                                        @elseif(strtolower($bayar->status_pembayaran) == 'menunggu')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-black uppercase tracking-wider rounded-full bg-amber-100 text-amber-800 animate-pulse">
                                                MENUNGGU
                                            </span>
                                        @elseif(strtolower($bayar->status_pembayaran) == 'ditolak')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-black uppercase tracking-wider rounded-full bg-red-600 text-white" title="{{ $bayar->keterangan_tolak }}">
                                                DITOLAK
                                            </span>
                                        @else
                                            <div class="flex flex-col items-center gap-2">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-black uppercase tracking-wider rounded-full bg-red-100 text-red-800">
                                                    BELUM LUNAS
                                                </span>
                                                <form action="{{ route('pembayaran.kirim-tagihan', $bayar->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Kirim notifikasi peringatan tagihan ke pelanggan ini?')" class="inline-flex items-center justify-center px-2 py-1 text-[10px] font-bold text-white transition-colors bg-orange-500 rounded hover:bg-orange-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                                        Kirim Tagihan
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex flex-wrap items-center justify-center gap-3">
                                            
                                            @if(strtolower($bayar->status_pembayaran) == 'menunggu')
                                                <form action="{{ route('pembayaran.konfirmasi', $bayar->id) }}" method="POST" class="inline-block">
                                                    @csrf @method('PUT')
                                                    <button type="submit" onclick="return confirm('Validasi bukti transfer ini dan ubah status menjadi LUNAS?')" class="text-white bg-blue-600 hover:bg-blue-700 font-black px-3 py-1.5 rounded text-[10px] uppercase tracking-wider shadow-sm transition">
                                                        Verifikasi Lunas
                                                    </button>
                                                </form>
                                                <form action="{{ route('pembayaran.tolak', $bayar->id) }}" method="POST" class="inline-block" id="form-tolak-{{ $bayar->id }}">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="keterangan_tolak" id="keterangan-tolak-{{ $bayar->id }}">
                                                    <button type="button" onclick="tolakPembayaran({{ $bayar->id }})" class="text-white bg-red-600 hover:bg-red-700 font-black px-3 py-1.5 rounded text-[10px] uppercase tracking-wider shadow-sm transition">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('pembayaran.edit', $bayar->id) }}" class="text-blue-500 hover:text-blue-700 font-bold text-xs uppercase tracking-wider">Edit</a>
                                            <form action="{{ route('pembayaran.destroy', $bayar->id) }}" method="POST" class="inline-block form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus riwayat ini secara permanen?')" class="text-red-500 hover:text-red-700 font-bold text-xs uppercase tracking-wider">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="py-8 text-center text-slate-500 font-medium">Belum ada riwayat pembayaran yang diinput.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script>
        function tolakPembayaran(id) {
            let alasan = prompt("Masukkan alasan penolakan (misal: Upload bukti pembayaran dengan benar):");
            if (alasan != null && alasan.trim() !== "") {
                document.getElementById('keterangan-tolak-' + id).value = alasan;
                document.getElementById('form-tolak-' + id).submit();
            } else if (alasan !== null) {
                alert("Alasan penolakan tidak boleh kosong!");
            }
        }
    </script>
</x-app-layout>