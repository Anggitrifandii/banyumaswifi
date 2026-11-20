<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Pusat Bantuan & Live Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1">
                <div class="bg-white shadow-sm shadow-slate-200/50 sm:rounded-2xl p-6 border-t-4 border-red-500">
                    <h3 class="text-lg font-bold text-[#1a44a6] mb-2">Buat Tiket Baru</h3>
                    <p class="text-xs text-slate-500 mb-6">Ceritakan kendala koneksi Anda di sini, tim teknisi kami akan merespons melalui fitur chat di samping.</p>

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 text-sm rounded shadow-sm shadow-slate-200/50">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('client.bantuan.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 mb-1 uppercase tracking-wide">Pilih Jenis Kendala <span class="text-red-500">*</span></label>
                            <select name="jenis_gangguan" class="w-full rounded-xl border-gray-300 shadow-sm shadow-slate-200/50 text-sm focus:border-red-500 focus:ring-red-500 bg-slate-50" required>
                                <option value="" disabled selected>-- Pilih Masalah --</option>
                                <option value="Internet Mati / LOS Merah">Internet Mati / LOS Merah</option>
                                <option value="Koneksi Lambat">Koneksi Sangat Lambat</option>
                                <option value="Kabel Putus">Kabel Optik Putus</option>
                                <option value="Lupa Password WiFi">Bantuan Lupa Password WiFi</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-700 mb-1 uppercase tracking-wide">Ceritakan Detailnya</label>
                            <textarea name="deskripsi" rows="4" class="w-full rounded-xl border-gray-300 shadow-sm shadow-slate-200/50 text-sm focus:border-red-500 focus:ring-red-500 bg-slate-50" placeholder="Contoh: Lampu LOS di router warna merah berkedip..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-extrabold text-sm py-3 rounded-xl shadow-lg shadow-red-500/30 transition transform hover:-translate-y-0.5 flex justify-center items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Kirim Tiket Chat
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200 flex flex-col h-[600px]">
                    
                    <div class="p-4 border-b border-slate-200 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-500 to-orange-500 flex items-center justify-center text-white font-bold mr-3 shadow">
                                CS
                            </div>
                            <div>
                                <h3 class="font-bold text-[#1a44a6] text-sm">Riwayat Percakapan Bantuan</h3>
                                <p class="text-xs text-green-600 font-medium">Tim CS Online & Siap Membantu</p>
                            </div>
                        </div>
                        @if(isset($globalPengaturan) && $globalPengaturan->no_telp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $globalPengaturan->no_telp) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1 transition-colors shadow-sm shrink-0">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                                WA CS
                            </a>
                        @endif
                    </div>

                    <div x-data x-init="$el.scrollTop = $el.scrollHeight" class="flex-1 overflow-y-auto p-6 space-y-8 bg-[#E5DDD5]"> 
                        
                        @forelse($tikets as $tiket)
                            <div class="flex justify-center my-4">
                                <span class="bg-blue-50/80 text-blue-800 text-[10px] font-bold uppercase px-3 py-1 rounded-full shadow-sm shadow-slate-200/50">
                                    Tiket: {{ \Carbon\Carbon::parse($tiket->tanggal_lapor)->translatedFormat('d M Y') }} - Status: 
                                    <span class="{{ $tiket->status_tiket == 'Selesai' ? 'text-green-600' : 'text-red-600' }}">{{ $tiket->status_tiket }}</span>
                                </span>
                            </div>

                            <div class="flex justify-end mb-4">
                                <div class="bg-[#dcf8c6] max-w-[80%] rounded-2xl rounded-tr-none p-3 shadow-sm shadow-slate-200/50 relative"> <span class="block text-xs font-bold text-green-800 mb-1 border-b border-green-200/50 pb-1">Anda (Pelaporan Kendala)</span>
                                    <p class="text-sm font-bold text-[#1a44a6]">{{ $tiket->jenis_gangguan }}</p>
                                    <p class="text-sm text-gray-700 leading-relaxed">{{ $tiket->deskripsi ?? '-' }}</p>
                                    <span class="block text-right text-[10px] text-slate-500 mt-2">{{ \Carbon\Carbon::parse($tiket->created_at)->format('H:i') }}</span>
                                </div>
                            </div>

                            @if($tiket->balasan_admin)
                                <div class="flex justify-start mb-4">
                                    <div class="bg-white max-w-[80%] rounded-2xl rounded-tl-none p-3 shadow-sm shadow-slate-200/50 relative">
                                        <span class="block text-xs font-bold text-blue-600 mb-1 border-b border-slate-200 pb-1">Admin BanyumasWiFi</span>
                                        <p class="text-sm text-[#1a44a6] leading-relaxed">{{ $tiket->balasan_admin }}</p>
                                        <span class="block text-right text-[10px] text-slate-500 mt-2">{{ \Carbon\Carbon::parse($tiket->updated_at)->format('H:i') }} ✓✓</span>
                                    </div>
                                </div>
                            @elseif($tiket->status_tiket != 'Menunggu Teknisi')
                                <div class="flex justify-start mb-4">
                                    <div class="bg-white max-w-[80%] rounded-2xl rounded-tl-none p-3 shadow-sm shadow-slate-200/50 relative italic">
                                        <span class="block text-xs font-bold text-blue-600 mb-1 border-b border-slate-200 pb-1">Admin BanyumasWiFi</span>
                                        <p class="text-sm text-slate-500">Halo! Kendala Anda sedang dalam penanganan oleh tim kami. Mohon ditunggu ya...</p>
                                    </div>
                                </div>
                            @endif
                            
                        @empty
                            <div class="flex justify-center items-center h-full flex-col opacity-50">
                                <svg class="w-16 h-16 text-slate-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                                <p class="text-slate-600 text-sm font-medium">Belum ada percakapan. Silakan mulai obrolan!</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
