<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Manajemen Penugasan Teknisi') }}
        </h2>
    </x-slot>

    <div class="py-8" x-data="{ openAdd: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-sm shadow-slate-200/50 mb-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-[#1a44a6]">Pusat Komando Lapangan</h3>
                        <p class="text-xs text-slate-500 font-medium">Buat dan pantau jadwal kerja teknisi lapangan secara *real-time*.</p>
                    </div>
                </div>
                <button @click="openAdd = true" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Jadwal Tugas
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tugas as $t)
                    <div class="bg-white rounded-2xl shadow-sm shadow-slate-200/50 border border-slate-200 overflow-hidden hover:shadow-md transition duration-300 flex flex-col">
                        
                        <div class="px-5 py-3 border-b border-slate-200 flex justify-between items-center
                            {{ $t->status == 'Selesai' ? 'bg-green-50' : ($t->status == 'Sedang Dikerjakan' ? 'bg-blue-50' : 'bg-yellow-50') }}">
                            <span class="text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded-md
                                {{ $t->status == 'Selesai' ? 'bg-green-200 text-green-800' : ($t->status == 'Sedang Dikerjakan' ? 'bg-blue-200 text-blue-800' : 'bg-yellow-200 text-yellow-800 animate-pulse') }}">
                                {{ $t->status }}
                            </span>
                            
                            <form action="{{ route('teknisi.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-500 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </form>
                        </div>

                        <div class="p-5 flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase text-white shadow-sm shadow-slate-200/50
                                    {{ $t->jenis_tugas == 'Instalasi Baru' ? 'bg-indigo-500' : ($t->jenis_tugas == 'Perbaikan Gangguan' ? 'bg-red-500' : 'bg-orange-500') }}">
                                    {{ $t->jenis_tugas }}
                                </span>
                            </div>
                            <h4 class="font-black text-[#1a44a6] text-lg leading-tight mb-2">{{ $t->judul_tugas }}</h4>
                            
                            <div class="space-y-2 mt-4">
                                <div class="flex items-start gap-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 mt-0.5 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="font-medium line-clamp-2">{{ $t->lokasi_alamat }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="font-bold text-indigo-600">{{ \Carbon\Carbon::parse($t->jadwal_kunjungan)->format('d F Y') }}</span>
                                </div>
                                
                                <div class="flex items-center gap-2 text-sm text-slate-600 mt-1">
                                    <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span class="font-bold text-[#1a44a6] border-b border-gray-300 border-dashed pb-0.5">PIC: {{ $t->teknisi->nama ?? 'Teknisi Belum Dipilih/Dihapus' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 border-t border-slate-200 space-y-3">
                            
                            <a href="{{ route('teknisi.cetak', $t->id) }}" target="_blank" class="w-full bg-white hover:bg-indigo-50 text-indigo-700 font-bold py-2 px-4 rounded-lg border border-indigo-200 shadow-sm shadow-slate-200/50 transition flex justify-center items-center gap-2 text-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Cetak Surat Tugas
                            </a>

                            <form action="{{ route('teknisi.updateStatus', $t->id) }}" method="POST" class="flex gap-2">
                                @csrf @method('PUT')
                                <select name="status" class="text-xs rounded-lg border-gray-300 flex-1 font-bold text-gray-700 shadow-sm shadow-slate-200/50" onchange="this.form.submit()">
                                    <option value="Menunggu" {{ $t->status == 'Menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                                    <option value="Sedang Dikerjakan" {{ $t->status == 'Sedang Dikerjakan' ? 'selected' : '' }}>🔧 Dikerjakan</option>
                                    <option value="Selesai" {{ $t->status == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                </select>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-500 bg-white border border-dashed border-gray-300 rounded-2xl">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <p class="font-bold text-lg">Hore! Semua Tugas Selesai.</p>
                        <p class="text-sm">Belum ada jadwal penugasan lapangan untuk teknisi saat ini.</p>
                    </div>
                @endforelse
            </div>

            <div x-show="openAdd" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" style="display: none;" x-transition>
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden" @click.away="openAdd = false">
                    <div class="bg-indigo-600 p-4 text-white flex justify-between items-center font-bold">
                        <span>Formulir Penugasan Baru</span>
                        <button @click="openAdd = false" class="hover:text-indigo-200 text-2xl leading-none">&times;</button>
                    </div>
                    <form action="{{ route('teknisi.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Judul / Instruksi Tugas</label>
                            <input type="text" name="judul_tugas" class="w-full rounded-lg border-gray-300" placeholder="Misal: Pasang router baru atas nama Pak Budi" required>
                        </div>
                        
                        <div class="bg-indigo-50/50 p-3 rounded-lg border border-indigo-100">
                            <label class="block text-xs font-bold text-indigo-900 mb-1">Pilih Teknisi Penanggung Jawab (PIC)</label>
                            <select name="teknisi_id" class="w-full rounded-lg border-gray-300 font-bold text-indigo-700 shadow-sm shadow-slate-200/50" required>
                                <option value="">-- Silakan Pilih Teknisi --</option>
                                @foreach($teknisis as $tek)
                                    <option value="{{ $tek->id }}">{{ $tek->nama }} ({{ $tek->no_telp }})</option>
                                @endforeach
                            </select>
                            @if($teknisis->isEmpty())
                                <p class="text-[10px] font-bold text-red-500 mt-1.5 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Daftar teknisi kosong. Harap tambahkan di menu Data Teknisi!
                                </p>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Jenis Pekerjaan</label>
                                <select name="jenis_tugas" class="w-full rounded-lg border-gray-300">
                                    <option value="Instalasi Baru">Instalasi Baru</option>
                                    <option value="Perbaikan Gangguan">Perbaikan Gangguan</option>
                                    <option value="Tarik Kabel">Tarik Kabel / Relokasi</option>
                                    <option value="Maintenance">Maintenance Rutin</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Jadwal Kunjungan</label>
                                <input type="date" name="jadwal_kunjungan" class="w-full rounded-lg border-gray-300" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Lokasi / Alamat Lengkap</label>
                            <textarea name="lokasi_alamat" rows="2" class="w-full rounded-lg border-gray-300" placeholder="Detail alamat untuk teknisi..." required></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Catatan Opsional</label>
                            <input type="text" name="catatan" class="w-full rounded-lg border-gray-300 placeholder-gray-400" placeholder="Bawa kabel 50 meter, dll...">
                        </div>
                        
                        <button type="submit" class="w-full font-black py-3 rounded-xl shadow-lg transition mt-2 
                            {{ $teknisis->isEmpty() ? 'bg-gray-300 text-slate-500 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-700 text-white' }}"
                            {{ $teknisis->isEmpty() ? 'disabled' : '' }}>
                            Terbitkan Surat Tugas 🚀
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
