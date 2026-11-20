<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BanyumasWiFi by LDP - Internet Fiber Optik Terbaik</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        html { scroll-behavior: smooth; } /* Tambahan agar scroll ke Tentang Kami halus */
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body x-data="{ showLoginModal: {{ $errors->any() ? 'true' : 'false' }} }" class="antialiased bg-slate-50 text-slate-800 selection:bg-[#1a44a6] selection:text-white flex flex-col min-h-screen overflow-x-hidden">
    
    <div class="fixed top-0 inset-x-0 h-[100vh] overflow-hidden -z-10 pointer-events-none bg-slate-50">
        <div class="absolute -top-[20%] -right-[10%] w-[50vw] h-[50vw] rounded-full bg-gradient-to-br from-blue-300/40 to-cyan-200/40 blur-[100px]"></div>
        <div class="absolute top-[10%] -left-[10%] w-[40vw] h-[40vw] rounded-full bg-gradient-to-tr from-[#1a44a6]/20 to-indigo-300/20 blur-[120px]"></div>
    </div>

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200/80 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#1a44a6] to-blue-500 shadow-sm flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-slate-800">Banyumas<span class="text-[#1a44a6]">WiFi</span></span>
                </div>
                <div class="flex items-center gap-5">
                    
                    <a href="#tentang-kami" class="text-sm font-semibold text-slate-600 hover:text-[#1a44a6] transition hidden md:block outline-none cursor-pointer">Tentang Kami</a>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-600 hover:text-[#1a44a6] transition">Beranda Saya</a>
                        @else
                            <button @click="showLoginModal = true" class="text-sm font-semibold text-slate-600 hover:text-[#1a44a6] transition hidden sm:block outline-none cursor-pointer">Masuk Pelanggan</button>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold rounded-full text-white bg-[#1a44a6] hover:bg-blue-800 transition shadow-sm hover:-translate-y-px">Daftar Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center pt-32 pb-16 px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-4xl mx-auto text-center flex flex-col items-center">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-blue-200/60 bg-blue-50/50 backdrop-blur-md shadow-sm mb-6 animate-fade-in-up">
                <span class="flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-blue-500 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-[#1a44a6]"></span>
                </span>
                <span class="text-[10px] font-bold text-[#1a44a6] uppercase tracking-[0.15em]">Koneksi Fiber Optik Tercepat</span>
            </div>

            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6 leading-tight animate-fade-in-up" style="animation-delay: 0.1s;">
                Koneksi Tanpa Batas, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#1a44a6] to-cyan-500">BanyumasWiFi by LDP</span>
            </h1>
            
            <p class="text-base sm:text-lg text-slate-500 mb-8 max-w-2xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s;">
                Tingkatkan rutinitas digital Anda dengan koneksi internet stabil 100% tanpa FUP, sistem layanan mandiri 24/7, dan jaminan kualitas terbaik di area Anda.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center gap-3 w-full sm:w-auto animate-fade-in-up" style="animation-delay: 0.3s;">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 text-sm font-semibold rounded-full text-white bg-[#1a44a6] hover:bg-blue-800 transition shadow-md shadow-blue-500/20 hover:shadow-lg hover:-translate-y-0.5">
                            Akses Beranda Saya 
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                    @else
                        <a href="#katalog-paket" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-3 text-sm font-semibold rounded-full text-slate-700 bg-white border border-slate-200 hover:border-[#1a44a6] hover:text-[#1a44a6] transition shadow-sm hover:shadow hover:-translate-y-0.5">
                            Lihat Pilihan Paket
                        </a>
                        <button @click="showLoginModal = true" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 text-sm font-semibold rounded-full text-white bg-[#1a44a6] hover:bg-blue-800 transition shadow-md shadow-blue-500/20 hover:shadow-lg hover:-translate-y-0.5 outline-none cursor-pointer">
                            Masuk Pelanggan
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    @endauth
                @endif
            </div>

            <div class="mt-16 pt-8 border-t border-slate-200/60 w-full max-w-3xl flex flex-col md:flex-row items-center justify-center gap-8 opacity-70 grayscale hover:grayscale-0 transition duration-500 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                    <span class="text-sm font-semibold text-slate-700">Keamanan Enkripsi</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <span class="text-sm font-semibold text-slate-700">Uptime 99.9%</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="text-sm font-semibold text-slate-700">Layanan CS 24/7</span>
                </div>
            </div>
        </div>
    </main>

    <section id="tentang-kami" class="py-24 bg-white relative z-10 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 text-[#1a44a6] border border-blue-100 text-[10px] font-bold tracking-[0.15em] uppercase mb-4">
                        Tentang Kami
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 leading-tight">
                        Membangun Ekosistem Digital <br>di <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#1a44a6] to-cyan-500">Banyumas & Sekitarnya</span>
                    </h2>
                    <p class="text-slate-600 text-lg mb-6 leading-relaxed font-medium">
                        BanyumasWiFi by LDP hadir sebagai solusi penyedia layanan internet (ISP) modern yang didesain khusus untuk memenuhi kebutuhan digital tingkat tinggi. Kami percaya bahwa koneksi internet bukan sekadar fasilitas, melainkan urat nadi produktivitas masyarakat.
                    </p>
                    <p class="text-slate-600 text-lg mb-8 leading-relaxed font-medium">
                        Dibangun dengan infrastruktur <span class="font-bold text-slate-800">Fiber Optic</span> terbaik dan sistem manajemen jaringan cerdas, kami berkomitmen memberikan layanan yang transparan, dapat diandalkan, dan dapat dikelola langsung oleh pelanggan melalui portal pintar kami.
                    </p>

                    <div class="grid grid-cols-2 gap-8 pt-8 border-t border-slate-100 mt-4">
                        <div>
                            <h4 class="text-4xl font-black text-[#1a44a6] mb-2">100%</h4>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Tanpa Batas Kuota</p>
                        </div>
                        <div>
                            <h4 class="text-4xl font-black text-[#1a44a6] mb-2">Real-Time</h4>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Sistem Tagihan</p>
                        </div>
                    </div>
                </div>

                <div class="relative animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-100/60 to-cyan-100/40 rounded-[2.5rem] transform rotate-3 scale-105 transition hover:rotate-6 duration-500"></div>
                    
                    <img src="https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Infrastruktur BanyumasWiFi" class="relative rounded-[2.5rem] shadow-xl object-cover h-[500px] w-full border-4 border-white">
                    
                </div>

            </div>
        </div>
    </section>

    <section id="katalog-paket" class="py-16 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-[#1a44a6] font-bold text-[10px] uppercase tracking-[0.15em] block mb-3 bg-blue-50 border border-blue-100 py-1.5 px-3 rounded-full inline-block">Katalog Internet</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-4">Pilih Kecepatan Sesuai Kebutuhan</h2>
                <p class="text-slate-500 text-base">Layanan fiber optik dengan harga transparan tanpa syarat tersembunyi. Pasang hari ini dan ciptakan ekosistem cerdas di rumah Anda.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-stretch">
                @forelse($pakets as $index => $paket)
                <div class="relative bg-white rounded-3xl p-1 hover:shadow-lg transition-all duration-300 flex flex-col {{ $index == 1 ? 'bg-gradient-to-br from-[#1a44a6] to-cyan-400 shadow-md transform md:-translate-y-2' : 'border border-slate-200 shadow-sm' }}">
                    
                    @if($index == 1)
                    <div class="absolute -top-3.5 inset-x-0 flex justify-center z-20">
                        <span class="bg-gradient-to-r from-amber-400 to-yellow-500 text-amber-950 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">Paling Populer</span>
                    </div>
                    @endif

                    <div class="p-6 md:p-8 flex flex-col flex-grow bg-white rounded-[1.35rem] h-full">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-slate-800 mb-1.5 transition-colors">{{ $paket->nama_paket }}</h3>
                            <p class="text-slate-500 text-xs font-medium mb-5">Cocok untuk {{ $paket->kecepatan }} gadget sekaligus.</p>
                            <div class="flex items-end gap-1 mb-2">
                                <span class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                                <span class="text-sm text-slate-400 font-semibold mb-1">/bln</span>
                            </div>
                        </div>
                        
                        <div class="w-full h-px bg-slate-100 my-5"></div>
                        
                        <ul class="space-y-3.5 mb-8 flex-grow text-sm font-medium text-slate-600">
                            <li class="flex items-start">
                                <div class="w-5 h-5 rounded-full bg-blue-50 flex items-center justify-center mr-3 shrink-0 text-[#1a44a6]">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span>Kecepatan stabil <strong>{{ $paket->kecepatan }}</strong></span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-5 h-5 rounded-full bg-blue-50 flex items-center justify-center mr-3 shrink-0 text-[#1a44a6]">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span>100% Unlimited tanpa FUP</span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-5 h-5 rounded-full bg-blue-50 flex items-center justify-center mr-3 shrink-0 text-[#1a44a6]">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span>Perangkat Router Premium</span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-5 h-5 rounded-full bg-blue-50 flex items-center justify-center mr-3 shrink-0 text-[#1a44a6]">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span>Bantuan Teknisi Prioritas</span>
                            </li>
                        </ul>
                        
                        @if (Route::has('register'))
                            <a href="{{ route('register', ['paket_id' => $paket->id]) }}" class="w-full text-center block outline-none mt-auto {{ $index == 1 ? 'bg-[#1a44a6] text-white hover:bg-blue-800 border-transparent shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-[#1a44a6] hover:text-white border-slate-200 hover:border-[#1a44a6]' }} text-sm font-semibold py-3 rounded-xl transition border">
                                Langganan Sekarang
                            </a>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16 bg-slate-50/50 rounded-3xl border border-slate-200 border-dashed">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200 shadow-sm">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <p class="text-slate-800 font-bold text-lg mb-1">Pembaruan Sistem</p>
                    <p class="text-slate-500 text-sm max-w-md mx-auto">Katalog paket internet sedang dalam tahap pemantapan server. Silakan hubungi Customer Service kami untuk langganan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-white px-4 sm:px-6 lg:px-8 py-10">
        <div class="max-w-6xl mx-auto bg-slate-50 rounded-3xl p-8 md:p-10 border border-slate-200">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#1a44a6] to-blue-500 shadow-sm flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-slate-800">Banyumas<span class="text-[#1a44a6]">WiFi</span></span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-sm font-medium">Penyedia layanan internet fiber optik prioritas pertama untuk ekosistem rumah pintar dan bisnis Anda.</p>
                </div>
                
                <div>
                    <h4 class="font-bold text-slate-900 mb-4 uppercase tracking-widest text-xs">Hubungi Kami</h3>
                    <ul class="space-y-2 text-sm font-medium text-slate-500">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Kantor Banyumas Raya
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            0812-3456-7890
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            hello@banyumaswifi.id
                        </li>
                    </ul>
                </div>
            </div>
            <div class="pt-6 border-t border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-slate-500 font-medium text-xs">
                    &copy; {{ date('Y') }} BanyumasWiFi by LDP. All rights reserved.
                </p>
                <div class="flex items-center gap-2">
                    <a href="#" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-slate-400 hover:bg-[#1a44a6] hover:text-white transition shadow-sm border border-slate-100"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-slate-400 hover:bg-[#1a44a6] hover:text-white transition shadow-sm border border-slate-100"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.20 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
                </div>
            </div>
        </div>
    </footer>

    <div x-show="showLoginModal" x-transition.opacity style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-0">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showLoginModal = false"></div>
        
        <div class="relative z-10 w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl rounded-xl border-[4px] border-white/20 bg-clip-padding transition-all transform" 
             x-show="showLoginModal" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <button @click="showLoginModal = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 rounded-full bg-white shadow flex items-center justify-center -mt-16 border-4 border-white mb-2">
                    <svg class="w-8 h-8 text-[#0d6efd]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-slate-800 mb-6 text-center">Login</h2>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="flex items-center text-sm font-semibold text-slate-700 mb-1.5">
                        <svg class="w-4 h-4 mr-1.5 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        Username
                    </label>
                    <input id="email" class="block w-full px-4 py-2 text-sm border border-slate-300 rounded focus:ring-[#0d6efd] focus:border-[#0d6efd] outline-none transition" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    @error('email')
                        <p class="text-sm text-red-600 mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="flex items-center text-sm font-semibold text-slate-700 mb-1.5">
                        <svg class="w-4 h-4 mr-1.5 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                        Password
                    </label>
                    <input id="password" class="block w-full px-4 py-2 text-sm border border-slate-300 rounded focus:ring-[#0d6efd] focus:border-[#0d6efd] outline-none transition" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <p class="text-sm text-red-600 mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between text-xs mt-3">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#0d6efd] shadow-sm focus:ring-[#0d6efd]" name="remember">
                        <span class="ms-2 font-medium text-slate-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="font-medium text-[#0d6efd] hover:underline transition" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-[#0d6efd] hover:bg-blue-700 text-white font-bold py-2.5 rounded transition duration-200 mt-4 outline-none">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>