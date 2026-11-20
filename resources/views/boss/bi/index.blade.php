<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Business Intelligence & Analisis Bisnis') }}
            </h2>
            <div class="text-xs text-slate-400 font-bold uppercase tracking-widest">
                Executive Portal
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white border border-slate-200 rounded-[2rem] p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4">
                    <div class="p-2.5 bg-blue-50 text-[#1a44a6] rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-800 uppercase tracking-wider">Ikhtisar Performa Perusahaan</h3>
                        <p class="text-xs text-slate-500 font-medium">Data kalkulasi bisnis dihitung secara real-time dari aktivitas jaringan utama.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-blue-50/40 border border-blue-100 rounded-2xl shadow-sm">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider">Total Klien Terdaftar</p>
                        <p class="text-4xl font-black text-slate-800 mt-3 tracking-tight">{{ $totalKlien }} <span class="text-sm text-slate-400 font-bold">User</span></p>
                        <p class="text-[10px] text-slate-400 font-medium mt-2">*Akumulasi total pengguna portal.</p>
                    </div>

                    <div class="p-6 bg-emerald-50/40 border border-emerald-100 rounded-2xl shadow-sm">
                        <p class="text-xs font-bold text-emerald-500 uppercase tracking-wider">Akumulasi Pendapatan Bersih</p>
                        <p class="text-4xl font-black text-slate-800 mt-3 tracking-tight">Rp {{ number_format($omzetMurni, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-slate-400 font-medium mt-2">*Dihitung dari seluruh tagihan berstatus lunas.</p>
                    </div>

                    <div class="p-6 bg-purple-50/40 border border-purple-100 rounded-2xl shadow-sm">
                        <p class="text-xs font-bold text-purple-500 uppercase tracking-wider">Rata-Rata Nilai Produk Paket</p>
                        <p class="text-4xl font-black text-slate-800 mt-3 tracking-tight">Rp {{ number_format($rataRataTagihan, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-slate-400 font-medium mt-2">*Nilai tengah dari variasi harga paket aktif.</p>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-amber-50 border border-amber-200 text-amber-800 rounded-2xl text-xs font-medium flex items-center gap-3">
                <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span><strong>Informasi Sistem:</strong> Modul optimasi eksternal (Voucher, WhatsApp Gateway, GIS Pemetaan, & Live Traffic Core) telah berhasil dinonaktifkan sepenuhnya demi stabilitas performa server utama.</span>
            </div>

        </div>
    </div>
</x-app-layout>