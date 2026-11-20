<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Tiket Bantuan & Pengaduan Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200">
                <div class="p-6 text-slate-800">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                            <span class="font-bold">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6 border-b border-slate-200 pb-4">
                        <h3 class="text-lg font-bold text-[#1a44a6] flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            Log Gangguan & Live Chat
                        </h3>
                        <a href="{{ route('pengaduan.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-5 rounded-lg shadow transition">
                            + Buat Tiket Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="min-w-full bg-white">
                            <thead class="bg-slate-50 border-b border-slate-200 text-left text-xs uppercase font-semibold text-slate-500 tracking-wider">
                                <tr>
                                    <th class="py-4 px-6 w-48">Tanggal & Status</th>
                                    <th class="py-4 px-6 w-48">Pelapor</th>
                                    <th class="py-4 px-6">Pesan Kendala (Chat Pelanggan)</th>
                                    <th class="py-4 px-6 text-center w-64">Aksi Balas & Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-slate-100">
                                @forelse($pengaduans as $tiket)
                                <tr class="hover:bg-red-50/30 transition">
                                    <td class="py-4 px-6">
                                        <p class="font-bold text-[#1a44a6]">{{ \Carbon\Carbon::parse($tiket->tanggal_lapor)->translatedFormat('d M Y') }}</p>
                                        <span class="inline-block mt-2 px-2 py-1 text-[10px] font-black uppercase rounded {{ $tiket->status_tiket == 'Menunggu Teknisi' ? 'bg-red-100 text-red-700' : ($tiket->status_tiket == 'Sedang Diperbaiki' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                            {{ $tiket->status_tiket }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-bold text-slate-800">{{ $tiket->pelanggan->nama ?? 'Terhapus' }}</p>
                                        <p class="text-xs text-slate-500">{{ $tiket->pelanggan->no_hp ?? '-' }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="bg-slate-50 p-3 rounded-lg border border-slate-200 relative">
                                            <div class="absolute w-3 h-3 bg-slate-50 border-l border-t border-slate-200 transform -rotate-45 -left-1.5 top-4"></div>
                                            <p class="text-red-600 font-bold mb-1">{{ $tiket->jenis_gangguan }}</p>
                                            <p class="text-slate-600 text-xs">{{ $tiket->deskripsi ?? 'Tidak ada pesan tambahan.' }}</p>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center" x-data="{ openReply: false }">
                                        <button @click="openReply = !openReply" class="bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-1.5 px-4 rounded transition border border-blue-200 shadow-sm shadow-slate-200/50 w-full mb-2 flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                            Balas & Update
                                        </button>
                                        
                                        <div x-show="openReply" x-transition class="absolute z-10 right-10 mt-2 w-80 bg-white rounded-2xl border border-slate-200 shadow-sm shadow-2xl border border-slate-200 p-4 text-left">
                                            <form action="{{ route('pengaduan.update', $tiket->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                
                                                <label class="block text-xs font-bold text-gray-700 mb-1">Ubah Status</label>
                                                <select name="status_tiket" class="w-full text-sm border-gray-300 rounded mb-3">
                                                    <option value="Menunggu Teknisi" {{ $tiket->status_tiket == 'Menunggu Teknisi' ? 'selected' : '' }}>Menunggu Teknisi</option>
                                                    <option value="Sedang Diperbaiki" {{ $tiket->status_tiket == 'Sedang Diperbaiki' ? 'selected' : '' }}>Sedang Diperbaiki</option>
                                                    <option value="Selesai" {{ $tiket->status_tiket == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>

                                                <label class="block text-xs font-bold text-gray-700 mb-1">Ketik Balasan Chat</label>
                                                <textarea name="balasan_admin" rows="3" class="w-full text-sm border-gray-300 rounded mb-3" placeholder="Ketik balasan untuk pelanggan...">{{ $tiket->balasan_admin }}</textarea>
                                                
                                                <div class="flex gap-2">
                                                    <button type="button" @click="openReply = false" class="w-1/3 bg-slate-100 hover:bg-gray-200 text-gray-700 text-xs font-bold py-2 rounded">Batal</button>
                                                    <button type="submit" class="w-2/3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2 rounded">Kirim Balasan 🚀</button>
                                                </div>
                                            </form>
                                        </div>

                                        <form action="{{ route('pengaduan.destroy', $tiket->id) }}" method="POST" class="inline-block w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-bold hover:underline w-full mt-2">Hapus Tiket</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="py-12 text-center text-slate-500 font-medium">Yeay! Belum ada tiket pengaduan masuk. Semua jaringan aman!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
