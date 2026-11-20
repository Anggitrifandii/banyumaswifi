<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Manajemen Pengumuman') }}
        </h2>
    </x-slot>

    <div class="py-8" x-data="{ openAdd: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-t-2xl border-b border-slate-200 p-6 flex justify-between items-center shadow-sm shadow-slate-200/50">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-3.124 8.461-7.221C18.237 1.834 19 3.322 19 5.093v13.814c0 1.771-.763 3.259-1.707 6.315C16.457 21.124 12.932 18 8.832 18H7a4 4 0 01-1.564-.317z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-[#1a44a6]">Pusat Informasi Pelanggan</h3>
                        <p class="text-xs text-slate-500 font-medium">Buat pengumuman gangguan atau promo yang akan tampil di dashboard klien.</p>
                    </div>
                </div>
                <button @click="openAdd = true" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Pengumuman
                </button>
            </div>

            <div class="bg-white rounded-b-2xl shadow-sm shadow-slate-200/50 overflow-hidden border border-t-0 border-slate-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($pengumumans as $p)
                        <div class="border {{ $p->tipe == 'warning' ? 'border-red-200 bg-red-50/30' : ($p->tipe == 'promo' ? 'border-green-200 bg-green-50/30' : 'border-blue-200 bg-blue-50/30') }} rounded-xl p-5 relative">
                            
                            <div class="flex justify-between items-start mb-3">
                                <span class="px-2 py-1 text-[10px] font-black uppercase rounded {{ $p->tipe == 'warning' ? 'bg-red-100 text-red-600' : ($p->tipe == 'promo' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600') }}">
                                    {{ $p->tipe }}
                                </span>
                                <form action="{{ route('pengumuman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-slate-500 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                </form>
                            </div>
                            
                            <h4 class="font-bold text-[#1a44a6] mb-2">{{ $p->judul }}</h4>
                            <p class="text-sm text-slate-600 line-clamp-3">{{ $p->isi_pengumuman }}</p>
                            <p class="text-[10px] text-slate-500 mt-4">{{ $p->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <div class="col-span-full py-8 text-center text-slate-500">Belum ada pengumuman yang disiarkan.</div>
                    @endforelse
                </div>
            </div>

            <div x-show="openAdd" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" style="display: none;" x-transition>
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden" @click.away="openAdd = false">
                    <div class="bg-indigo-600 p-4 text-white flex justify-between items-center font-bold">
                        <span>Draft Pengumuman Baru</span>
                        <button @click="openAdd = false" class="hover:text-indigo-200 text-2xl leading-none">&times;</button>
                    </div>
                    <form action="{{ route('pengumuman.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Judul Info</label>
                            <input type="text" name="judul" class="w-full rounded-lg border-gray-300" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Tipe Pesan</label>
                            <select name="tipe" class="w-full rounded-lg border-gray-300">
                                <option value="info">🔵 Info Umum</option>
                                <option value="warning">🔴 Warning / Gangguan / Maintenance</option>
                                <option value="promo">🟢 Promo Spesial</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Isi Pesan</label>
                            <textarea name="isi_pengumuman" rows="4" class="w-full rounded-lg border-gray-300" required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-3 rounded-xl transition">Siarkan Sekarang 📢</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
