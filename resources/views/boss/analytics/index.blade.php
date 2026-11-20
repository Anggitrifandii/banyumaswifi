<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Business Intelligence & Forecasting') }}
        </h2>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl p-8 shadow-2xl text-white relative overflow-hidden border border-yellow-500/20">
                <svg class="absolute right-0 top-0 opacity-5 w-64 h-64 transform translate-x-10 -translate-y-10" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                
                <div class="flex flex-col md:flex-row justify-between items-center gap-6 relative z-10">
                    <div class="flex items-center gap-5">
                        <div class="p-4 bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 rounded-2xl shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl sm:text-3xl font-black text-white tracking-tight">Business <span class="text-yellow-400">Intelligence</span></h3>
                            <p class="text-sm text-slate-300 mt-1">Laporan Tahunan Terkonsolidasi & Proyeksi Pertumbuhan ISP.</p>
                        </div>
                    </div>
                    <div class="bg-slate-950/50 px-5 py-3 rounded-xl border border-slate-700/50 backdrop-blur-md text-right">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status Proyeksi AI</p>
                        <div class="flex items-center gap-2 justify-end">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-sm font-black text-emerald-400">DATA TERSINKRONISASI</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-50 rounded-2xl p-6 border-l-4 border-yellow-500 shadow-sm shadow-slate-200/50 flex items-start gap-4">
                <div class="p-2 bg-yellow-200 text-yellow-700 rounded-lg shrink-0 mt-0.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-yellow-800 uppercase tracking-wider mb-1">Smart System Insight</h4>
                    <p class="text-sm text-yellow-900 leading-relaxed">
                        Berdasarkan analisis <span class="font-bold border-b border-yellow-400">Regresi Linear</span> dari kuartal 3 dan 4, diproyeksikan pendapatan kotor perusahaan akan menyentuh <span class="font-black text-emerald-600">Rp 140.000.000</span> pada akhir tahun. Margin laba bersih (*Net Profit Margin*) stabil di angka <strong>46.4%</strong>. <br>
                        <strong>Rekomendasi Eksekutif:</strong> Disarankan untuk mengalokasikan 20% laba untuk perluasan infrastruktur OLT di kuartal depan guna menampung lonjakan proyeksi 300+ pelanggan baru.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm shadow-slate-200/50 border border-slate-200">
                    <div class="mb-4">
                        <h4 class="font-black text-[#1a44a6] text-lg">Performa Finansial Tahunan</h4>
                        <p class="text-xs text-slate-500">Pendapatan vs Pengeluaran Operasional (Dalam Juta Rupiah)</p>
                    </div>
                    <div class="relative h-80 w-full">
                        <canvas id="financeChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm shadow-slate-200/50 border border-slate-200 flex flex-col">
                    <div class="mb-4 text-center">
                        <h4 class="font-black text-[#1a44a6] text-lg">Market Share Paket</h4>
                        <p class="text-xs text-slate-500">Distribusi Pemakaian Layanan</p>
                    </div>
                    <div class="relative flex-1 w-full flex items-center justify-center min-h-[250px]">
                        <canvas id="paketChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm shadow-slate-200/50 border border-slate-200">
                <div class="mb-4 flex justify-between items-center">
                    <div>
                        <h4 class="font-black text-[#1a44a6] text-lg">Proyeksi Pertumbuhan Klien (Forecast)</h4>
                        <p class="text-xs text-slate-500">Tren pendaftaran pelanggan historis & prediksi masa depan.</p>
                    </div>
                    <div class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded text-xs font-bold border border-indigo-100">
                        Tren Naik (Upward)
                    </div>
                </div>
                <div class="relative h-72 w-full">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            // ==============================================
            // 1. GRAFIK KEUANGAN (BAR CHART)
            // ==============================================
            const ctxFinance = document.getElementById('financeChart').getContext('2d');
            new Chart(ctxFinance, {
                type: 'bar',
                data: {
                    labels: {!! $chartBulan !!},
                    datasets: [
                        {
                            label: 'Pendapatan Kotor (Juta Rp)',
                            data: {!! $chartPendapatan !!},
                            backgroundColor: '#10b981', // Emerald
                            borderRadius: 6,
                            borderSkipped: false
                        },
                        {
                            label: 'Beban Operasional (Juta Rp)',
                            data: {!! $chartPengeluaran !!},
                            backgroundColor: '#ef4444', // Red
                            borderRadius: 6,
                            borderSkipped: false
                        }
                    ]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', labels: { font: { family: 'system-ui', weight: 'bold' } } }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDashOffset: [2, 4], color: '#f1f5f9' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // ==============================================
            // 2. GRAFIK MARKET SHARE PAKET (DOUGHNUT CHART)
            // ==============================================
            const ctxPaket = document.getElementById('paketChart').getContext('2d');
            new Chart(ctxPaket, {
                type: 'doughnut',
                data: {
                    labels: ['Paket Hemat (30Mbps)', 'Paket Cepat (50Mbps)', 'Paket Gaming (100Mbps)'],
                    datasets: [{
                        data: [45, 35, 20],
                        backgroundColor: ['#3b82f6', '#eab308', '#8b5cf6'], // Blue, Yellow, Purple
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '70%',
                    plugins: {
                        legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15, font: { size: 11 } } }
                    }
                }
            });

            // ==============================================
            // 3. GRAFIK PROYEKSI PERTUMBUHAN (LINE CHART)
            // ==============================================
            const ctxGrowth = document.getElementById('growthChart').getContext('2d');
            new Chart(ctxGrowth, {
                type: 'line',
                data: {
                    labels: {!! $growthBulan !!},
                    datasets: [{
                        label: 'Total Pelanggan Aktif',
                        data: {!! $growthData !!},
                        borderColor: '#6366f1', // Indigo
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#6366f1',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.4,
                        // Membuat garis putus-putus untuk 2 bulan terakhir (Simulasi Prediksi)
                        segment: {
                            borderDash: ctx => ctx.p0DataIndex >= 4 ? [6, 6] : undefined,
                            borderColor: ctx => ctx.p0DataIndex >= 4 ? '#9ca3af' : '#6366f1',
                        }
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: false, grid: { color: '#f1f5f9' } },
                        x: { grid: { display: false } }
                    }
                }
            });

        });
    </script>
</x-app-layout>
