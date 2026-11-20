<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Manajemen Inventaris Perangkat') }}
        </h2>
    </x-slot>

    <div class="py-8" x-data="{ openAdd: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                    <p class="font-bold">Gagal Menyimpan! Ada kesalahan input:</p>
                    <ul class="list-disc ml-5 text-sm mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-t-2xl border-b border-slate-200 p-6 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-sm shadow-slate-200/50">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-[#1a44a6]">Stok Gudang ISP</h3>
                        <p class="text-xs text-slate-500 font-medium">Pantau ketersediaan Router, Kabel, dan Modem.</p>
                    </div>
                </div>
                <button @click="openAdd = true" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition flex items-center gap-2 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Barang
                </button>
            </div>

            <div class="bg-white rounded-b-2xl shadow-sm shadow-slate-200/50 overflow-hidden border border-t-0 border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-[11px] font-black text-slate-500 uppercase tracking-widest">Nama Perangkat & Kategori</th>
                                <th class="px-6 py-4 text-center text-[11px] font-black text-slate-500 uppercase tracking-widest">Sisa Stok</th>
                                <th class="px-6 py-4 text-center text-[11px] font-black text-slate-500 uppercase tracking-widest">Kondisi</th>
                                <th class="px-6 py-4 text-right text-[11px] font-black text-slate-500 uppercase tracking-widest">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($inventaris as $item)
                                <tr class="hover:bg-blue-50/20 transition" x-data="{ modalType: null }">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-800 text-sm">{{ $item->nama_perangkat }}</p>
                                        <p class="text-xs text-blue-600 font-bold mt-1 bg-blue-50 inline-block px-2 py-0.5 rounded">{{ $item->kategori }}</p>
                                        @if($item->keterangan) <p class="text-[10px] text-slate-500 mt-1 italic">{{ $item->keterangan }}</p> @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-lg font-black {{ $item->stok < 5 ? 'text-red-500 animate-pulse' : 'text-[#1a44a6]' }}">{{ $item->stok }}</span>
                                        <span class="text-xs text-slate-500 ml-1">Unit</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider 
                                            {{ $item->kondisi == 'Baik' ? 'bg-green-100 text-green-700' : ($item->kondisi == 'Rusak' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ $item->kondisi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                                        <button @click="modalType = 'tambah'" class="bg-green-50 text-green-600 hover:bg-green-600 hover:text-white font-bold py-1.5 px-3 rounded shadow-sm shadow-slate-200/50 text-xs transition">+ Masuk</button>
                                        <button @click="modalType = 'kurang'" class="bg-orange-50 text-orange-600 hover:bg-orange-500 hover:text-white font-bold py-1.5 px-3 rounded shadow-sm shadow-slate-200/50 text-xs transition">- Keluar</button>
                                        <button @click="modalType = 'set'" class="bg-yellow-50 text-yellow-600 hover:bg-yellow-500 hover:text-white font-bold py-1.5 px-3 rounded shadow-sm shadow-slate-200/50 text-xs transition" title="Edit Data">Edit</button>
                                        
                                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus perangkat ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold py-1.5 px-3 rounded shadow-sm shadow-slate-200/50 text-xs transition">Hapus</button>
                                        </form>

                                        <div x-show="modalType !== null" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" style="display: none;" x-transition>
                                            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden text-left" @click.away="modalType = null">
                                                <div class="p-4 flex justify-between items-center text-white" :class="modalType === 'tambah' ? 'bg-green-600' : (modalType === 'kurang' ? 'bg-orange-500' : 'bg-yellow-500')">
                                                    <h3 class="font-bold" x-text="modalType === 'tambah' ? 'Stok Masuk: {{ addslashes($item->nama_perangkat) }}' : (modalType === 'kurang' ? 'Stok Keluar: {{ addslashes($item->nama_perangkat) }}' : 'Edit Stok: {{ addslashes($item->nama_perangkat) }}')"></h3>
                                                    <button @click="modalType = null" class="hover:text-white/70 text-xl leading-none">&times;</button>
                                                </div>
                                                <form action="{{ route('inventaris.update', $item->id) }}" method="POST" class="p-6 space-y-4">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="jenis_update" :value="modalType">
                                                    
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-700 mb-1" x-text="modalType === 'tambah' ? 'Jumlah Barang Masuk' : (modalType === 'kurang' ? 'Jumlah Barang Keluar' : 'Set Jumlah Stok Baru')"></label>
                                                        <input type="number" name="jumlah" value="0" min="0" class="w-full rounded-lg border-gray-300" required>
                                                        <p class="text-[10px] text-slate-500 mt-1">Stok saat ini: {{ $item->stok }} Unit</p>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-700 mb-1">Kondisi Dominan</label>
                                                        <select name="kondisi" class="w-full rounded-lg border-gray-300">
                                                            <option value="Baik" {{ $item->kondisi == 'Baik' ? 'selected' : '' }}>🟢 Baik (Siap Pasang)</option>
                                                            <option value="Digunakan" {{ $item->kondisi == 'Digunakan' ? 'selected' : '' }}>🟡 Digunakan (Di Pelanggan)</option>
                                                            <option value="Rusak" {{ $item->kondisi == 'Rusak' ? 'selected' : '' }}>🔴 Rusak (Butuh Perbaikan)</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="w-full text-white font-black py-3 rounded-xl shadow-lg transition" :class="modalType === 'tambah' ? 'bg-green-600 hover:bg-green-700' : (modalType === 'kurang' ? 'bg-orange-500 hover:bg-orange-600' : 'bg-yellow-500 hover:bg-yellow-600')">Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500 font-medium">Gudang kosong. Belum ada perangkat yang ditambahkan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div x-show="openAdd" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" style="display: none;" x-transition>
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden" @click.away="openAdd = false">
                    <div class="bg-blue-600 p-4 text-white flex justify-between items-center font-bold">
                        <span>Tambah Perangkat Baru</span>
                        <button @click="openAdd = false" class="hover:text-blue-200 text-2xl leading-none">&times;</button>
                    </div>
                    <form action="{{ route('inventaris.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Merek & Nama Perangkat</label>
                            <input type="text" name="nama_perangkat" class="w-full rounded-lg border-gray-300" placeholder="Contoh: ZTE F609" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Kategori</label>
                                <select name="kategori" class="w-full rounded-lg border-gray-300">
                                    <option value="Router">Router / AP</option>
                                    <option value="Modem ONT">Modem ONT</option>
                                    <option value="Kabel">Kabel Drop Core</option>
                                    <option value="Switch/Hub">Switch / Hub</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Jumlah Unit (Stok)</label>
                                <input type="number" name="stok" class="w-full rounded-lg border-gray-300" value="1" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Kondisi Awal</label>
                            <select name="kondisi" class="w-full rounded-lg border-gray-300">
                                <option value="Baik">🟢 Kondisi Baik (Baru/Normal)</option>
                                <option value="Digunakan">🟡 Sedang Digunakan</option>
                                <option value="Rusak">🔴 Rusak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Catatan (Opsional)</label>
                            <textarea name="keterangan" rows="2" class="w-full rounded-lg border-gray-300" placeholder="Contoh: Pembelian Batch 1 - Garansi 1 Tahun"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-3 rounded-xl shadow-lg transition">Tambahkan ke Gudang 🚀</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
