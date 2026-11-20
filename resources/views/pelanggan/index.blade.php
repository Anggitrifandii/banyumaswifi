<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
                {{ __('Data Pelanggan & Monitoring Jatuh Tempo') }}
            </h2>
            <div class="text-xs text-slate-400 font-bold uppercase tracking-widest hidden sm:block">
                Home / <span class="text-[#1a44a6]">Pelanggan</span>
            </div>
        </div>
    </x-slot>

    <!-- x-data untuk mengontrol state Modal Hapus -->
    <div class="py-12" x-data="{ showDeleteModal: false, deleteUrl: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Alert -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm shadow-slate-200/50 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-lg border border-slate-200">
                <div class="p-6 text-slate-800">
                    
                    <!-- Header Tabel -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Pelanggan Banyumaswifi</h3>
                        <a href="{{ route('pelanggan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition">
                            + Tambah Pelanggan
                        </a>
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto rounded-lg border border-slate-200 shadow-sm shadow-slate-200/50">
                        <table class="min-w-full bg-white">
                            <thead class="bg-slate-50 border-b border-slate-200 text-left text-[11px] uppercase font-bold text-slate-500 tracking-wider">
                                <tr>
                                    <th class="py-4 px-6">Nama Pelanggan</th>
                                    <th class="py-4 px-6 text-center">Paket Internet</th>
                                    <th class="py-4 px-6 text-center">Tgl Awal Pasang</th>
                                    <th class="py-4 px-6 text-center bg-blue-50/50 text-[#1a44a6]">Tanggal Jatuh Tempo</th>
                                    <th class="py-4 px-6 text-center">Status Tagihan</th>
                                    <th class="py-4 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                                @forelse($pelanggans as $p)
                                <tr class="hover:bg-slate-50 transition duration-150">
                                    <td class="py-3 px-6">
                                        <div class="font-bold text-slate-800">{{ $p->nama }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono mt-0.5">{{ $p->no_hp ?? '-' }}</div>
                                    </td>
                                    <td class="py-3 px-6 text-center text-slate-600 font-medium">
                                        {{ $p->paket->nama_paket ?? 'Tidak Ada Paket' }}
                                    </td>
                                    <td class="py-3 px-6 text-center text-slate-600">
                                        {{ $p->tanggal_pasang ? \Carbon\Carbon::parse($p->tanggal_pasang)->translatedFormat('d M Y') : '-' }}
                                    </td>
                                    <td class="py-3 px-6 text-center font-bold text-[#1a44a6] bg-blue-50/30">
                                        {{ $p->tanggal_jatuh_tempo ? \Carbon\Carbon::parse($p->tanggal_jatuh_tempo)->translatedFormat('d M Y') : '-' }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        @if(strtoupper($p->status_tagihan_bulan_ini) == 'LUNAS')
                                            <span class="px-3 py-1 inline-flex text-[10px] font-black tracking-wider rounded-full bg-green-100 text-green-700 uppercase">
                                                LUNAS
                                            </span>
                                        @elseif(strtoupper($p->status_tagihan_bulan_ini) == 'NONAKTIF')
                                            <span class="px-3 py-1 inline-flex text-[10px] font-black tracking-wider rounded-full bg-gray-100 text-gray-600 uppercase">
                                                NONAKTIF
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-[10px] font-black tracking-wider rounded-full bg-red-100 text-red-700 uppercase animate-pulse">
                                                BELUM BAYAR
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center flex justify-center items-center gap-3 mt-1">
                                        <a href="{{ route('pelanggan.edit', $p->id) }}" class="text-blue-500 hover:text-blue-700 text-xs font-bold transition">Edit</a>
                                        
                                        <!-- Tombol Pemicu Modal -->
                                        <button type="button" 
                                                @click="showDeleteModal = true; deleteUrl = '{{ route('pelanggan.destroy', $p->id) }}'" 
                                                class="text-red-500 hover:text-red-700 text-xs font-bold transition">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-slate-500 font-medium">
                                        Belum ada data pelanggan yang terdaftar.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- MODAL KONFIRMASI HAPUS (ALPINE.JS) -->
        <!-- ========================================== -->
        <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" style="display: none;" x-transition.opacity>
            <!-- Konten Modal -->
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all" 
                 x-show="showDeleteModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 @click.away="showDeleteModal = false">
                
                <div class="p-8 text-center">
                    <!-- Ikon Peringatan -->
                    <div class="w-20 h-20 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Konfirmasi Hapus Data</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-8">
                        Apakah Anda yakin ingin menghapus pelanggan ini secara permanen? Data riwayat pembayaran dan aset yang terkait mungkin akan ikut terhapus.
                    </p>
                    
                    <!-- Tombol Aksi Modal -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <button type="button" @click="showDeleteModal = false" class="w-full sm:w-auto px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-xl transition-colors">
                            Batal
                        </button>
                        
                        <!-- Form Eksekusi Hapus -->
                        <form :action="deleteUrl" method="POST" class="w-full sm:w-auto m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-extrabold rounded-xl shadow-lg shadow-red-500/30 transition-all transform hover:-translate-y-0.5">
                                Ya, Hapus Permanen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>