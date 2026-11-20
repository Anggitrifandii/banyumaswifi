<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($globalPengaturan) && $globalPengaturan->nama_aplikasi ? $globalPengaturan->nama_aplikasi : config('app.name', 'BanyumasWiFi') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800 bg-[#f4f7fb]" x-data="{ sidebarOpen: false }">
        <div class="flex h-screen overflow-hidden">
            
            @if(Auth::user()->role !== 'pelanggan')
            <div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-gray-900/80 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" x-transition.opacity style="display: none;"></div>

            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white text-slate-600 border-r border-slate-200 transition-transform duration-300 lg:static lg:translate-x-0 flex flex-col shadow-2xl">
                
                <div class="flex items-center justify-between lg:justify-center h-16 border-b border-slate-100 px-4 bg-white shrink-0">
                    <div class="flex items-center">
                        <div class="p-1.5 bg-white rounded shadow-sm mr-2">
                            <svg class="w-5 h-5 text-[#1a44a6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                        </div>
                        <span class="text-lg font-extrabold tracking-wider uppercase text-[#1a44a6]">
                            {{ isset($globalPengaturan) && $globalPengaturan->nama_aplikasi ? $globalPengaturan->nama_aplikasi : 'BanyumasWiFi' }}
                        </span>
                    </div>
                    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto py-6 px-3 space-y-1 custom-scrollbar">
                    
                    @if(Auth::user()->role === 'boss')
                        <p class="px-3 text-[10px] font-black uppercase tracking-widest text-[#1a44a6]/70 mb-2 mt-2">Executive Panel</p>
                        
                        <a href="{{ route('boss.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('boss.dashboard') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            Analitik Bisnis
                        </a>

                        <a href="{{ route('boss.laporan.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('boss.laporan.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Audit Keuangan
                        </a>

                        <a href="{{ route('boss.bi.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('boss.bi.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            Business Intelligence
                        </a>

                        <a href="{{ route('boss.staf.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('boss.staf.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Manajemen Staf
                        </a>

                        <a href="{{ route('boss.log.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('boss.log.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Log Aktivitas Sistem
                        </a>

                    @elseif(Auth::user()->role === 'admin')
                        @php
                            $pembayaranPendingCount = \App\Models\Pembayaran::where('status_pembayaran', 'menunggu')->count();
                            $tiketPendingCount = \App\Models\Pengaduan::where('status_tiket', 'Menunggu Teknisi')->count();
                        @endphp
                        <p class="px-3 text-[10px] font-black uppercase tracking-widest text-[#1a44a6]/70 mb-2 mt-2">Menu Utama</p>

                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Dashboard Admin
                        </a>

                        <p class="px-3 text-[10px] font-black uppercase tracking-widest text-[#1a44a6]/70 mb-2 mt-6">Master Data</p>
                        
                        <a href="{{ route('paket.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('paket.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            Data Paket
                        </a>
                        
                        <a href="{{ route('pelanggan.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('pelanggan.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Data Pelanggan
                        </a>

                        <a href="{{ route('inventaris.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('inventaris.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                            Inventaris Perangkat
                        </a>

                        <p class="px-3 text-[10px] font-black uppercase tracking-widest text-[#1a44a6]/70 mb-2 mt-6">Transaksi & Layanan</p>

                        <a href="{{ route('pembayaran.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('pembayaran.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Pembayaran
                            </div>
                            @if($pembayaranPendingCount > 0)
                                <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $pembayaranPendingCount }}</span>
                            @endif
                        </a>


                        <a href="{{ route('pengaduan.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('pengaduan.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                Tiket Bantuan
                            </div>
                            @if($tiketPendingCount > 0)
                                <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $tiketPendingCount }}</span>
                            @endif
                        </a>

                        <a href="{{ route('pengumuman.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('pengumuman.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-3.124 8.461-7.221C18.237 1.834 19 3.322 19 5.093v13.814c0 1.771-.763 3.259-1.707 6.315C16.457 21.124 12.932 18 8.832 18H7a4 4 0 01-1.564-.317z"></path></svg>
                            Broadcast Pengumuman
                        </a>

                        <a href="{{ route('laporan.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('laporan.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Laporan Keuangan
                        </a>

                        <p class="px-3 text-[10px] font-black uppercase tracking-widest text-[#1a44a6]/70 mb-2 mt-6">Operasional Lapangan</p>

                        <a href="{{ route('data-teknisi.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('data-teknisi.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Data Teknisi
                        </a>

                        <a href="{{ route('teknisi.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('teknisi.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Penugasan Teknisi
                        </a>

                        <p class="px-3 text-[10px] font-black uppercase tracking-widest text-[#1a44a6]/70 mb-2 mt-6">Pusat Kontrol Sistem</p>

                        <a href="{{ route('pengaturan.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('pengaturan.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Pengaturan Sistem
                        </a>

                        <a href="{{ route('akun.index') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('akun.*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            Reset Akun Pelanggan
                        </a>


                    @else
                        <p class="px-3 text-[10px] font-black uppercase tracking-widest text-[#1a44a6]/70 mb-2 mt-2">Menu Utama</p>

                        <a href="{{ route('client.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('client.dashboard') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Beranda Saya
                        </a>
                        <a href="{{ route('client.tagihan') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('client.tagihan*') || request()->routeIs('client.pembayaran*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Tagihan & Bayar
                        </a>

                        <a href="{{ route('client.router') }}" class="flex items-center px-4 py-3 rounded-xl font-bold text-sm transition-colors {{ request()->routeIs('client.router') ? 'bg-white text-[#1a44a6] shadow-md' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                            Status & Jaringan
                        </a>

                        <a href="{{ route('client.statistik') }}" class="flex items-center px-4 py-3 rounded-xl font-bold text-sm transition-colors {{ request()->routeIs('client.statistik') ? 'bg-white text-[#1a44a6] shadow-md' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                            Statistik & Speedtest
                        </a>

                        <a href="{{ route('client.voucher') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('client.voucher*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            Bisnis Voucher
                        </a>

                        <a href="{{ route('client.bantuan') }}" class="flex items-center px-3 py-2.5 rounded-lg font-bold text-sm transition-colors {{ request()->routeIs('client.bantuan*') ? 'bg-blue-50 text-[#1a44a6] border-l-4 border-[#1a44a6] shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Pusat Bantuan
                        </a>
                    @endif
                </div>

                <div class="p-4 border-t border-slate-100 bg-white shrink-0">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center justify-center w-full px-3 py-2.5 text-sm font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </aside>
            @endif

            <div class="flex-1 flex flex-col min-w-0 bg-gray-50 overflow-hidden">
                
                <header class="bg-[#0d6efd] shadow-sm sticky top-0 z-30 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0 border-b border-blue-600">
                    <div class="flex items-center w-full max-w-full overflow-hidden">
                        @if(Auth::user()->role !== 'pelanggan')
                            <button @click="sidebarOpen = true" class="text-white hover:text-blue-200 focus:outline-none lg:hidden mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>
                        @endif

                        @if(Auth::user()->role === 'pelanggan')
                            <div class="flex items-center mr-4 shrink-0">
                                <div class="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center mr-2">
                                    <svg class="w-4 h-4 text-[#0d6efd]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                                </div>
                                <span class="text-lg font-extrabold tracking-wider uppercase text-white">
                                    {{ isset($globalPengaturan) && $globalPengaturan->nama_aplikasi ? $globalPengaturan->nama_aplikasi : 'BanyumasWiFi' }}
                                </span>
                            </div>
                        @else
                            <!-- Hidden info in navbar for admins as they have sidebar branding -->
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="hidden sm:inline-block px-3 py-1 
                            {{ Auth::user()->role === 'boss' ? 'bg-yellow-100 text-yellow-800 border-yellow-200' : 'bg-white/20 text-white border-white/30' }} 
                            text-[10px] font-black rounded-full border uppercase tracking-widest">
                            AKSES {{ Auth::user()->role }}
                        </span>

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-white bg-transparent hover:text-blue-100 focus:outline-none transition ease-in-out duration-150 group">
                                    <div class="w-8 h-8 rounded-full bg-white text-[#0d6efd] flex items-center justify-center font-black mr-2 shadow-sm group-hover:scale-105 transition-transform">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')" class="font-semibold text-gray-700 hover:text-[#0d6efd]">
                                    {{ __('Pengaturan Profil') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();" class="font-bold text-red-600 hover:text-red-700 hover:bg-red-50">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto overflow-x-hidden p-4 md:p-6 lg:p-8 relative custom-scrollbar-main">
                    @if (isset($header) && Auth::user()->role !== 'pelanggan')
                        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white px-6 py-4 rounded-xl shadow-sm border border-slate-200">
                            <div class="font-semibold text-xl text-slate-800 leading-tight flex-1 w-full max-w-full overflow-hidden truncate">
                                {{ $header }}
                            </div>
                            <div class="text-[11px] font-bold text-[#0d6efd] uppercase tracking-widest mt-2 sm:mt-0 whitespace-nowrap hidden sm:block">
                                <a href="#" class="hover:underline">Home</a> <span class="mx-1 text-slate-400">/</span> Dashboard
                            </div>
                        </div>
                    @endisset

                    {{ $slot }}
                </main>

            </div>
        </div>

        <style>
            /* Mempercantik bentuk Scrollbar */
            .custom-scrollbar::-webkit-scrollbar { width: 4px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.4); }

            .custom-scrollbar-main::-webkit-scrollbar { width: 6px; }
            .custom-scrollbar-main::-webkit-scrollbar-track { background: #f1f5f9; }
            .custom-scrollbar-main::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
            .custom-scrollbar-main::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        </style>
    </body>
</html>





