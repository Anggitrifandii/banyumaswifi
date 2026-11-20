<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Pusat Bantuan & Pengaduan (Helpcenter)') }}
        </h2>
    </x-slot>

    <div class="py-8" x-data="{ activeFAQ: null, openForm: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 rounded-xl shadow-sm shadow-slate-200/50 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-2xl p-8 shadow-xl border border-blue-400 flex flex-col md:flex-row justify-between items-center gap-6 relative overflow-hidden">
                <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-10 translate-y-10">
                    <svg class="w-64 h-64 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                </div>
                
                <div class="flex items-center gap-5 relative z-10 w-full md:w-auto">
                    <div class="p-4 bg-white/10 border border-white/20 text-white rounded-2xl shadow-inner shrink-0">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-white tracking-tight">Hai Anggit, ada yang bisa kami bantu?</h3>
                        <p class="text-sm text-blue-100 mt-1">Temukan jawaban cepat di FAQ, atau hubungi teknisi kami untuk perbaikan jaringan.</p>
                    </div>
                </div>
                <button @click="openForm = true" class="relative z-10 bg-white text-blue-700 hover:bg-blue-50 font-black py-3 px-8 rounded-xl shadow-lg transition duration-300 w-full md:w-auto whitespace-nowrap">
                    📝 Buat Tiket Pengaduan
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                
                <div class="lg:col-span-2 space-y-4">
                    <h4 class="font-black text-[#1a44a6] text-lg flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pertanyaan Sering Diajukan (FAQ)
                    </h4>
                    
                    <div class="bg-white rounded-2xl shadow-sm shadow-slate-200/50 border border-slate-200 overflow-hidden">
                        <div class="border-b border-slate-200">
                            <button @click="activeFAQ = activeFAQ === 1 ? null : 1" class="w-full text-left px-6 py-4 font-bold text-gray-700 hover:bg-slate-50 flex justify-between items-center transition">
                                <span>Internet saya mati total (Lampu merah / LOS)</span>
                                <svg class="w-5 h-5 transform transition-transform" :class="{'rotate-180': activeFAQ === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="activeFAQ === 1" x-collapse class="px-6 pb-4 text-sm text-slate-600 bg-slate-50">
                                Ini biasanya menandakan kabel fiber optik yang masuk ke rumah Anda terputus atau tertekuk. Pastikan kabel tidak terjepit. Jika lampu LOS masih berkedip merah, segera buat Tiket Pengaduan agar teknisi kami meluncur ke lokasi.
                            </div>
                        </div>
                        
                        <div class="border-b border-slate-200">
                            <button @click="activeFAQ = activeFAQ === 2 ? null : 2" class="w-full text-left px-6 py-4 font-bold text-gray-700 hover:bg-slate-50 flex justify-between items-center transition">
                                <span>Koneksi WiFi terasa lambat atau putus-putus</span>
                                <svg class="w-5 h-5 transform transition-transform" :class="{'rotate-180': activeFAQ === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="activeFAQ === 2" x-collapse class="px-6 pb-4 text-sm text-slate-600 bg-slate-50">
                                Coba matikan router Anda, cabut colokan listriknya selama 1 menit, lalu nyalakan kembali. Ini akan merefresh cache jaringan. Anda juga bisa menggunakan fitur "Restart Router" di menu Status & Jaringan.
                            </div>
                        </div>

                        <div>
                            <button @click="activeFAQ = activeFAQ === 3 ? null : 3" class="w-full text-left px-6 py-4 font-bold text-gray-700 hover:bg-slate-50 flex justify-between items-center transition">
                                <span>Bagaimana cara mengganti Password WiFi?</span>
                                <svg class="w-5 h-5 transform transition-transform" :class="{'rotate-180': activeFAQ === 3}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="activeFAQ === 3" x-collapse class="px-6 pb-4 text-sm text-slate-600 bg-slate-50">
                                Saat ini penggantian password WiFi harus dibantu oleh sistem pusat kami untuk menghindari error enkripsi. Silakan buat Tiket Pengaduan, pilih kategori "Lainnya", dan tuliskan password baru yang Anda inginkan.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <h4 class="font-black text-[#1a44a6] text-lg flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Status Pelacakan Pengaduan Anda
                    </h4>

                    @if($riwayatTiket->count() > 0)
                        @php $tiketAktif = $riwayatTiket->first(); @endphp
                        
                        <div class="bg-white rounded-2xl shadow-sm shadow-slate-200/50 border border-slate-200 p-6 mb-6">
                            <div class="flex justify-between items-start border-b border-slate-200 pb-4 mb-6">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="bg-slate-100 text-slate-600 font-mono text-xs font-bold px-2 py-0.5 rounded">{{ $tiketAktif->nomor_tiket }}</span>
                                        <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded {{ $tiketAktif->status == 'Closed' || $tiketAktif->status == 'Resolved' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }}">
                                            Status: {{ $tiketAktif->status }}
                                        </span>
                                    </div>
                                    <h3 class="font-bold text-[#1a44a6] text-lg">{{ $tiketAktif->subjek }}</h3>
                                    <p class="text-xs text-slate-500 mt-1">Dilaporkan pada: {{ $tiketAktif->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="relative">
                                <div class="absolute inset-0 top-1/2 -translate-y-1/2 left-[10%] right-[10%] h-1 bg-gray-200 rounded-full z-0"></div>
                                <div class="absolute inset-0 top-1/2 -translate-y-1/2 left-[10%] h-1 bg-blue-500 rounded-full z-0 transition-all duration-1000" 
                                    style="width: {{ $tiketAktif->status == 'Open' ? '0%' : ($tiketAktif->status == 'In Progress' ? '40%' : '80%') }}">
                                </div>

                                <div class="relative z-10 flex justify-between">
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold border-4 border-white shadow-sm shadow-slate-200/50 transition-colors
                                            {{ $tiketAktif->status != '' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-slate-500' }}">
                                            1
                                        </div>
                                        <p class="text-[10px] font-bold mt-2 text-gray-700 text-center">Tiket Diterima<br><span class="text-slate-500 font-normal">Sistem</span></p>
                                    </div>

                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold border-4 border-white shadow-sm shadow-slate-200/50 transition-colors
                                            {{ $tiketAktif->status == 'In Progress' || $tiketAktif->status == 'Resolved' || $tiketAktif->status == 'Closed' ? 'bg-blue-500 text-white shadow-[0_0_15px_rgba(59,130,246,0.6)]' : 'bg-gray-200 text-slate-500' }}">
                                            @if($tiketAktif->status == 'In Progress')
                                                <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            @else
                                                2
                                            @endif
                                        </div>
                                        <p class="text-[10px] font-bold mt-2 text-gray-700 text-center">Sedang Ditangani<br><span class="text-slate-500 font-normal">Teknisi Lapangan</span></p>
                                    </div>

                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold border-4 border-white shadow-sm shadow-slate-200/50 transition-colors
                                            {{ $tiketAktif->status == 'Resolved' || $tiketAktif->status == 'Closed' ? 'bg-emerald-500 text-white' : 'bg-gray-200 text-slate-500' }}">
                                            @if($tiketAktif->status == 'Resolved' || $tiketAktif->status == 'Closed')
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            @else
                                                3
                                            @endif
                                        </div>
                                        <p class="text-[10px] font-bold mt-2 text-gray-700 text-center">Problem Selesai<br><span class="text-slate-500 font-normal">Koneksi Normal</span></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 bg-blue-50 border border-blue-100 p-3 rounded-lg text-xs text-blue-800 text-center font-medium">
                                @if($tiketAktif->status == 'Open')
                                    Laporan Anda telah masuk ke sistem. Mohon menunggu teknisi kami mengonfirmasi jadwal pengecekan.
                                @elseif($tiketAktif->status == 'In Progress')
                                    <strong>Teknisi sedang melakukan perbaikan!</strong> SLA Target Selesai: {{ \Carbon\Carbon::parse($tiketAktif->batas_waktu_sla)->format('H:i') }} WIB.
                                @else
                                    Perbaikan jaringan telah selesai dilakukan. Terima kasih atas kesabaran Anda menggunakan layanan BanyumasWiFi!
                                @endif
                            </div>
                        </div>

                        @if($riwayatTiket->count() > 1)
                            <h4 class="font-bold text-slate-600 text-sm mb-3 px-2">Riwayat Pengaduan Terdahulu</h4>
                            <div class="space-y-3">
                                @foreach($riwayatTiket->skip(1) as $old)
                                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm shadow-slate-200/50 flex justify-between items-center opacity-70 hover:opacity-100 transition">
                                        <div>
                                            <p class="text-xs font-bold text-[#1a44a6]">{{ $old->subjek }}</p>
                                            <p class="text-[10px] text-slate-500">{{ $old->created_at->format('d M Y') }} - {{ $old->nomor_tiket }}</p>
                                        </div>
                                        <span class="text-[9px] font-black uppercase px-2 py-1 rounded bg-slate-100 text-slate-600 border border-slate-200">
                                            {{ $old->status }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    @else
                        <div class="bg-white rounded-2xl shadow-sm shadow-slate-200/50 border border-slate-200 p-10 text-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h4 class="font-bold text-gray-700 text-lg">Belum Ada Pengaduan</h4>
                            <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Koneksi jaringan Anda terpantau aman. Jika terjadi kendala, jangan ragu untuk membuat tiket pengaduan.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div x-show="openForm" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm" style="display: none;" x-transition>
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-blue-500" @click.away="openForm = false">
                    <div class="bg-blue-600 p-4 text-white flex justify-between items-center font-bold">
                        <span>Formulir Laporan Kendala (Tiket)</span>
                        <button @click="openForm = false" class="hover:text-blue-200 text-2xl leading-none">&times;</button>
                    </div>
                    <form action="{{ route('client.bantuan.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Kategori Masalah</label>
                            <select name="kategori" class="w-full rounded-lg border-gray-300 font-bold text-blue-700 shadow-sm shadow-slate-200/50" required>
                                <option value="">-- Pilih Jenis Masalah --</option>
                                <option value="Koneksi Mati Total">🔴 Koneksi Mati Total (Lampu LOS Merah)</option>
                                <option value="Koneksi Lambat / Putus-Putus">🟡 Koneksi Terasa Lambat / Sering Putus</option>
                                <option value="Pergantian Password WiFi">🔵 Request Ganti Nama/Password WiFi</option>
                                <option value="Lainnya">⚪ Masalah Teknis Lainnya</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Judul Singkat</label>
                            <input type="text" name="subjek" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Misal: Internet mati setelah hujan deras" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Penjelasan Detail (Kronologi)</label>
                            <textarea name="deskripsi" rows="4" class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Jelaskan kendala yang Anda alami secara detail agar teknisi kami dapat mempersiapkan peralatannya..." required></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-3 rounded-xl shadow-lg transition mt-2">
                            KIRIM LAPORAN SEKARANG 🚀
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
