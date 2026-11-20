<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Beranda Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            @php
                $pelangganAktif = \App\Models\Pelanggan::where('user_id', Auth::id())->first();
                $notifikasis = $pelangganAktif ? \App\Models\Notifikasi::where('pelanggan_id', $pelangganAktif->id)->where('is_read', false)->get() : collect();
            @endphp

            @if($notifikasis->count() > 0)
                <div class="mb-6 space-y-3">
                    @foreach($notifikasis as $notif)
                        <div class="flex items-start gap-4 p-4 border-l-4 rounded-xl shadow-sm bg-orange-50 border-orange-500 shadow-slate-200/50">
                            <div class="p-2 bg-orange-100 rounded-full shrink-0">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-extrabold text-orange-800">{{ $notif->judul }}</h3>
                                <p class="text-xs font-medium text-orange-700 mt-1 leading-relaxed">{{ $notif->pesan }}</p>
                                <p class="text-[10px] font-bold text-orange-400 mt-2 uppercase tracking-widest">{{ $notif->created_at->diffForHumans() }}</p>
                            </div>
                            <form action="{{ route('client.notifikasi.read', $notif->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-slate-400 hover:text-slate-600 bg-white px-2 py-1 rounded shadow-sm border border-slate-200 transition-colors">Tandai Mengerti</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
            
            @if(isset($globalPengaturan) && $globalPengaturan->pesan_sambutan)
                <div class="mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-4 sm:p-5 rounded-2xl shadow-lg border border-blue-500/30 flex items-center gap-4 relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -mr-10 -mt-10 pointer-events-none"></div>
                    <div class="p-3 bg-white/20 rounded-full backdrop-blur-sm shrink-0 relative z-10">
                        <svg class="w-6 h-6 text-blue-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-3.124 8.461-7.221C18.237 1.834 19 3.322 19 5.093v13.814c0 1.771-.763 3.259-1.707 6.315C16.457 21.124 12.932 18 8.832 18H7a4 4 0 01-1.564-.317z"></path></svg>
                    </div>
                    <div class="relative z-10 flex-1">
                        <p class="font-bold text-white text-base leading-relaxed">{{ $globalPengaturan->pesan_sambutan }}</p>
                    </div>
                </div>
            @endif

            @if($profil)
                <div class="relative overflow-hidden bg-[#1a44a6] rounded-[2.5rem] p-1 shadow-2xl shadow-blue-900/20">
                    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-gradient-to-br from-blue-300 to-cyan-300 opacity-20 blur-3xl pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-gradient-to-tr from-indigo-400 to-purple-400 opacity-20 blur-3xl pointer-events-none"></div>

                    <div class="relative z-10 p-8 sm:p-12 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/10 rounded-full border border-white/20 backdrop-blur-md mb-5 text-white text-xs font-bold tracking-[0.2em] uppercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-cyan-300 animate-pulse"></span>
                                Client Portal Eksklusif
                            </div>
                            <h3 class="text-4xl md:text-5xl font-black text-white mb-3 tracking-tight">{{ $profil->nama }}</h3>
                            <p class="text-blue-100 flex items-center gap-2 text-sm sm:text-base font-medium opacity-90">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $profil->alamat ?? 'Alamat domisili belum terdata di sistem' }}
                            </p>
                        </div>
                        <div class="flex-shrink-0 flex gap-4 w-full lg:w-auto">
                            <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-5 text-center min-w-[180px] w-full lg:w-auto shadow-lg">
                                <p class="text-[10px] font-black text-blue-100 uppercase tracking-widest mb-3 opacity-90">Status Layanan</p>
                                @if(strtolower($profil->status) == 'aktif')
                                    <div class="inline-flex items-center justify-center w-full gap-2 bg-gradient-to-r from-emerald-400 to-green-500 text-white px-5 py-2.5 rounded-xl text-sm font-black shadow-lg shadow-green-500/30 border border-green-400/50">
                                        <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                                        AKTIF & OPTIMAL
                                    </div>
                                @else
                                    <div class="inline-flex items-center justify-center w-full gap-2 bg-gradient-to-r from-rose-400 to-red-500 text-white px-5 py-2.5 rounded-xl text-sm font-black shadow-lg shadow-red-500/30 border border-red-400/50">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                        NONAKTIF
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(isset($pengumumans) && $pengumumans->count() > 0)
                <div class="w-full">
                    <div class="flex items-center justify-between mb-6 px-2">
                        <h3 class="text-[13px] font-black text-slate-700 uppercase tracking-widest border-l-4 border-indigo-500 pl-3">Pusat Informasi & Notifikasi</h3>
                        <span class="bg-indigo-100 text-indigo-700 text-[10px] font-black px-3 py-1 rounded-full uppercase">{{ $pengumumans->count() }} Pemberitahuan</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($pengumumans as $p)
                            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
                                <div class="absolute left-0 top-0 bottom-0 w-2 {{ $p->tipe == 'warning' ? 'bg-rose-500' : ($p->tipe == 'promo' ? 'bg-emerald-500' : 'bg-blue-500') }} transition-all group-hover:w-3"></div>
                                
                                <div class="flex items-start gap-5 pl-2">
                                    <div class="shrink-0 mt-1">
                                        @if($p->tipe == 'warning')
                                            <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
                                        @elseif($p->tipe == 'promo')
                                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg></div>
                                        @else
                                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-col mb-2">
                                            <h4 class="text-lg font-black text-slate-800">{{ $p->judul }}</h4>
                                            <span class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-wider">
                                                {{ $p->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                        <p class="text-sm font-medium text-slate-500 leading-relaxed">{{ $p->isi_pengumuman }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($profil)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="flex items-center gap-5 mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-[#1a44a6] flex flex-shrink-0 items-center justify-center group-hover:bg-[#1a44a6] group-hover:text-white transition-colors duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Identifikasi Paket</p>
                                <p class="font-black text-slate-800 text-xl tracking-tight">{{ $profil->paket?->nama_paket ?? 'Tidak Ada Paket' }}</p>
                            </div>
                        </div>
                        <div class="pt-5 border-t border-slate-100 flex items-center justify-between text-sm">
                            <span class="text-slate-500 font-semibold text-xs">Aktivasi Otomatis</span>
                            <span class="text-green-500 font-bold bg-green-50 px-2.5 py-1 rounded-md text-xs">Berjalan Normal</span>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="flex items-center gap-5 mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-[#1a44a6] flex flex-shrink-0 items-center justify-center group-hover:bg-[#1a44a6] group-hover:text-white transition-colors duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Kecepatan Internet</p>
                                <p class="font-black text-slate-800 text-xl tracking-tight">{{ $profil->paket?->kecepatan ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="pt-5 border-t border-slate-100 flex items-center justify-between text-sm">
                            <span class="text-slate-500 font-semibold text-xs">Konsumsi Kuota</span>
                            <span class="text-blue-500 font-bold bg-blue-50 px-2.5 py-1 rounded-md text-xs">100% Unlimited</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="flex items-center gap-5 mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-[#1a44a6] flex flex-shrink-0 items-center justify-center group-hover:bg-[#1a44a6] group-hover:text-white transition-colors duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Tagihan Bulanan</p>
                                <p class="font-black text-slate-800 text-xl tracking-tight">Rp {{ number_format($profil->paket?->harga ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="pt-5 border-t border-slate-100 flex items-center justify-between text-sm">
                            <span class="text-slate-500 font-semibold text-xs">Status Bulan Ini</span>
                            @if($statusBulanIni == 'LUNAS')
                                <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-md font-bold text-[10px] uppercase tracking-wider">Telah Dilunasi</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-md font-bold text-[10px] uppercase tracking-wider animate-pulse">Belum Dibayar</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <div class="flex items-center justify-between mb-5 px-2">
                        <h3 class="text-[13px] font-black text-slate-700 uppercase tracking-widest border-l-4 border-emerald-500 pl-3">Menu Layanan Pelanggan</h3>
                    </div>
                    <div class="grid grid-cols-2 gap-4 sm:gap-6">
                        <a href="{{ route('client.tagihan') }}" class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 flex flex-col items-center justify-center text-center hover:bg-[#1a44a6] hover:border-[#1a44a6] hover:text-white transition-all duration-300 shadow-sm hover:shadow-2xl hover:-translate-y-2 group">
                            <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mb-4 transition-colors">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <span class="font-extrabold text-sm text-slate-700 group-hover:text-white">Tagihan & Bayar</span>
                            <p class="text-[10px] text-slate-400 group-hover:text-blue-200 mt-2">Cek riwayat & lunasi tagihan</p>
                        </a>

                        <a href="{{ route('client.bantuan') }}" class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 flex flex-col items-center justify-center text-center hover:bg-[#1a44a6] hover:border-[#1a44a6] hover:text-white transition-all duration-300 shadow-sm hover:shadow-2xl hover:-translate-y-2 group">
                            <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mb-4 transition-colors">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <span class="font-extrabold text-sm text-slate-700 group-hover:text-white">Pusat Bantuan</span>
                            <p class="text-[10px] text-slate-400 group-hover:text-blue-200 mt-2">Buat tiket & lapor kendala</p>
                        </a>
                    </div>
                </div>

            @else
                <div class="bg-white border border-slate-200 rounded-[3rem] p-16 text-center shadow-sm">
                    <div class="w-24 h-24 bg-yellow-50 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-800 mb-4 tracking-tight">Profil Belum Lengkap</h3>
                    <p class="text-slate-500 max-w-lg mx-auto text-lg leading-relaxed">Akun sistem Anda belum berhasil dihubungkan dengan identifikasi data pelanggan oleh Administrator kami. Silakan hubungi Customer Service untuk bantuan integrasi data Anda.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>