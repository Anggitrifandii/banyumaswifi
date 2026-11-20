<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl md:text-3xl text-slate-800 tracking-tight">
                    {{ __('Executive Dashboard') }}
                </h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Ringkasan performa bisnis dan operasional</p>
            </div>
            <div class="hidden sm:flex items-center gap-3 px-4 py-2 bg-emerald-50 border border-emerald-100 rounded-full shadow-sm">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest">Sistem Optimal</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- Statistic Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="relative overflow-hidden bg-slate-900 rounded-[2rem] p-6 shadow-xl group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full blur-3xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative flex flex-col h-full justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 text-emerald-400 flex items-center justify-center shadow-[inset_0_1px_0_rgba(255,255,255,0.1)] backdrop-blur-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 text-[10px] font-black uppercase tracking-widest border border-emerald-500/20">+12% Bulan ini</span>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Omzet Finansial</p>
                            <p class="text-3xl font-black text-white tracking-tight">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="relative overflow-hidden bg-slate-900 rounded-[2rem] p-6 shadow-xl group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full blur-3xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative flex flex-col h-full justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 text-blue-400 flex items-center justify-center shadow-[inset_0_1px_0_rgba(255,255,255,0.1)] backdrop-blur-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Basis Pelanggan</p>
                            <p class="text-3xl font-black text-white tracking-tight">{{ $totalPelanggan }} <span class="text-lg font-medium text-slate-500 ml-1">Klien</span></p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="relative overflow-hidden bg-slate-900 rounded-[2rem] p-6 shadow-xl group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full blur-3xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative flex flex-col h-full justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 text-indigo-400 flex items-center justify-center shadow-[inset_0_1px_0_rgba(255,255,255,0.1)] backdrop-blur-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-indigo-500/20 text-indigo-300 text-[10px] font-black uppercase tracking-widest border border-indigo-500/20">Online</span>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Layanan Aktif</p>
                            <p class="text-3xl font-black text-white tracking-tight">{{ $pelangganAktif }} <span class="text-lg font-medium text-slate-500 ml-1">Klien</span></p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="relative overflow-hidden bg-slate-900 rounded-[2rem] p-6 shadow-xl group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-gradient-to-br from-rose-400 to-rose-600 rounded-full blur-3xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative flex flex-col h-full justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 text-rose-400 flex items-center justify-center shadow-[inset_0_1px_0_rgba(255,255,255,0.1)] backdrop-blur-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            @if($tiketTerbuka > 0)
                                <span class="px-2.5 py-1 rounded-lg bg-rose-500/20 text-rose-300 text-[10px] font-black uppercase tracking-widest border border-rose-500/20 animate-pulse">Pending</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tiket Komplain</p>
                            <p class="text-3xl font-black text-white tracking-tight">{{ $tiketTerbuka }} <span class="text-lg font-medium text-slate-500 ml-1">Kasus</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Chart Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Chart -->
                <div class="lg:col-span-2 bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/40 border border-slate-200 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="font-black text-slate-800 text-lg tracking-tight">Grafik Pertumbuhan Finansial</h3>
                            <p class="text-xs font-medium text-slate-500 mt-1">Tren pendapatan (Omzet) 6 bulan terakhir</p>
                        </div>
                        <div class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-wider">Tahun Ini</div>
                    </div>
                    <div class="relative h-72 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Secondary Chart / Stats -->
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/40 border border-slate-200 p-8 flex flex-col">
                    <div class="mb-6">
                        <h3 class="font-black text-slate-800 text-lg tracking-tight">Status Layanan Klien</h3>
                        <p class="text-xs font-medium text-slate-500 mt-1">Distribusi status pelanggan saat ini</p>
                    </div>
                    <div class="relative flex-1 w-full flex items-center justify-center min-h-[200px]">
                        <canvas id="clientStatusChart"></canvas>
                    </div>
                    <div class="mt-6 flex justify-center gap-6">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                            <span class="text-xs font-bold text-slate-600">Aktif</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-400"></span>
                            <span class="text-xs font-bold text-slate-600">Nonaktif</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Chart 1: Revenue Line Chart
                    const ctxRev = document.getElementById('revenueChart').getContext('2d');
                    
                    const gradientRev = ctxRev.createLinearGradient(0, 0, 0, 300);
                    gradientRev.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
                    gradientRev.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

                    new Chart(ctxRev, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Bulan Ini'],
                            datasets: [{
                                label: 'Omzet (Rp)',
                                data: [1250000, 1800000, 1550000, 2100000, 1950000, {{ $totalPendapatan }}],
                                borderColor: '#10b981',
                                backgroundColor: gradientRev,
                                borderWidth: 3,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#10b981',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#1e293b',
                                    titleFont: { size: 13, family: 'sans-serif' },
                                    bodyFont: { size: 14, weight: 'bold', family: 'sans-serif' },
                                    padding: 12,
                                    cornerRadius: 8,
                                    displayColors: false,
                                    callbacks: {
                                        label: function(context) {
                                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: '#f1f5f9', drawBorder: false },
                                    ticks: {
                                        color: '#94a3b8',
                                        callback: function(value) {
                                            if(value >= 1000000) return (value / 1000000) + ' Jt';
                                            return value;
                                        }
                                    }
                                },
                                x: {
                                    grid: { display: false, drawBorder: false },
                                    ticks: { color: '#94a3b8' }
                                }
                            }
                        }
                    });

                    // Chart 2: Client Status Doughnut Chart
                    const ctxClient = document.getElementById('clientStatusChart').getContext('2d');
                    const totalClient = {{ $totalPelanggan }};
                    const activeClient = {{ $pelangganAktif }};
                    const inactiveClient = totalClient - activeClient;

                    new Chart(ctxClient, {
                        type: 'doughnut',
                        data: {
                            labels: ['Aktif', 'Nonaktif'],
                            datasets: [{
                                data: [activeClient, inactiveClient > 0 ? inactiveClient : 0],
                                backgroundColor: ['#34d399', '#fb7185'],
                                hoverBackgroundColor: ['#10b981', '#f43f5e'],
                                borderWidth: 0,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '75%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#1e293b',
                                    bodyFont: { size: 14, weight: 'bold', family: 'sans-serif' },
                                    padding: 12,
                                    cornerRadius: 8,
                                    displayColors: true
                                }
                            }
                        }
                    });
                });
            </script>

        </div>
    </div>
</x-app-layout>