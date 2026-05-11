@extends('Admin.layouts.app')

@section('title', 'Statistik Sistem')
@section('page-title', 'Statistik Sistem')

@section('content')

<div class="mb-6 md:mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1 md:mb-2">Statistik Sistem</h1>
    <p class="text-sm md:text-base text-gray-600">
        Pantau performa dan statistik sistem klasifikasi tomat
    </p>
</div>

<!-- =======================================================
CARD SUMMARY
======================================================= -->
<div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mb-6 md:mb-8">

    <!-- TOTAL -->
    <div class="stat-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-3 md:p-6">
        <div class="flex items-center justify-between mb-2 md:mb-4">

            <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-chart-bar text-blue-600 text-lg md:text-xl"></i>
            </div>

            <span class="text-xs font-medium px-2 py-1 rounded-full
                {{ $pctTotal >= 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }}">
                {{ $pctTotal >= 0 ? '+' : '' }}{{ $pctTotal }}%
            </span>
        </div>

        <h3 class="text-lg md:text-3xl font-bold text-gray-900">
            {{ number_format($totalKlasifikasi) }}
        </h3>

        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">
            Total Klasifikasi
        </p>
    </div>

    <!-- HARI INI -->
    <div class="stat-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-3 md:p-6">
        <div class="flex items-center justify-between mb-2 md:mb-4">

            <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-calendar-day text-green-600 text-lg md:text-xl"></i>
            </div>

            <span class="text-xs font-medium px-2 py-1 rounded-full
                {{ $pctHariIni >= 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }}">
                {{ $pctHariIni >= 0 ? '+' : '' }}{{ $pctHariIni }}%
            </span>
        </div>

        <h3 class="text-lg md:text-3xl font-bold text-gray-900">
            {{ number_format($klasifikasiHariIni) }}
        </h3>

        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">
            Klasifikasi Hari Ini
        </p>
    </div>

    <!-- AKURASI -->
    <div class="stat-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-3 md:p-6">
        <div class="flex items-center justify-between mb-2 md:mb-4">

            <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-100 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-bullseye text-purple-600 text-lg md:text-xl"></i>
            </div>

            <span class="text-xs text-gray-600 font-medium bg-gray-50 px-2 py-1 rounded-full">
                MODEL
            </span>
        </div>

        <h3 class="text-lg md:text-3xl font-bold text-gray-900">
            {{ number_format($akurasiRataRata, 2) }}%
        </h3>

        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">
            Akurasi Model
        </p>
    </div>

    <!-- ADMIN -->
    <div class="stat-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-3 md:p-6">
        <div class="flex items-center justify-between mb-2 md:mb-4">

            <div class="w-10 h-10 md:w-12 md:h-12 bg-orange-100 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-users text-orange-600 text-lg md:text-xl"></i>
            </div>

            <span class="text-xs text-gray-600 font-medium bg-gray-50 px-2 py-1 rounded-full">
                ADMIN
            </span>
        </div>

        <h3 class="text-lg md:text-3xl font-bold text-gray-900">
            {{ $penggunaAktifAdmin }}
        </h3>

        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">
            Pengguna Aktif Admin
        </p>
    </div>

</div>


<!-- =======================================================
CHARTS
======================================================= -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 mb-6">

    <!-- BAR -->
    <div class="chart-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-4 md:p-6">

        <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-1 md:mb-2">
            Jumlah Klasifikasi Harian
        </h2>

        <p class="text-xs md:text-sm text-gray-600 mb-4 md:mb-6">
            Statistik klasifikasi 7 hari terakhir
        </p>

        <div class="chart-container" style="height:250px">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <!-- LINE -->
    <div class="chart-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-4 md:p-6">

        <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-1 md:mb-2">
            Tren Klasifikasi Bulanan
        </h2>

        <p class="text-xs md:text-sm text-gray-600 mb-4 md:mb-6">
            Statistik klasifikasi 12 bulan terakhir
        </p>

        <div class="chart-container" style="height:250px">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

</div>



<!-- =======================================================
PIE CHART DATASET
======================================================= -->
<div class="chart-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-4 md:p-6">

    <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-1 md:mb-2">
        Distribusi Dataset Training Tomat
    </h2>

    <p class="text-xs md:text-sm text-gray-600 mb-4 md:mb-6">
        Berdasarkan dataset asli model klasifikasi
    </p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">

        <!-- PIE -->
        <div class="chart-container" style="height:280px">
            <canvas id="pieChart"></canvas>
        </div>

        <!-- LEGEND -->
        <div class="flex items-center justify-center">
            <div class="space-y-3 md:space-y-5 w-full max-w-sm">

                @foreach($distribusiData as $item)

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-2 md:gap-3">

                        <div class="w-3 h-3 md:w-4 md:h-4 rounded-full flex-shrink-0
                            {{ $loop->index == 0 ? 'bg-green-500' : ($loop->index == 1 ? 'bg-yellow-500' : 'bg-red-500') }}">
                        </div>

                        <span class="text-xs md:text-sm text-gray-700">
                            {{ $item['label'] }}
                        </span>
                    </div>

                    <div class="text-right">
                        <div class="text-xs md:text-sm font-semibold text-gray-900">
                            {{ $item['jumlah'] }} gambar
                        </div>

                        <div class="text-xs text-gray-500">
                            {{ $item['persentase'] }}%
                        </div>
                    </div>

                </div>

                @endforeach

            </div>
        </div>

    </div>
</div>

@endsection



@section('scripts')
<script>

// Tunggu sampai Chart.js library loaded
function initStatisticsCharts() {
    if (typeof Chart === 'undefined') {
        console.warn('Chart.js belum loaded, retry dalam 100ms');
        setTimeout(initStatisticsCharts, 100);
        return;
    }

    // Detect mobile
    const isMobileStats = window.innerWidth < 768;

    /* ==================================================
    BAR CHART
    ================================================== */
    try {
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: @json($hariLabels),
                datasets: [{
                    label: 'Jumlah',
                    data: @json($hariData),
                    backgroundColor: '#ef4444',
                    borderRadius: 8,
                    barThickness: isMobileStats ? 20 : 34,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display:false },
                    tooltip: {
                        titleFont: { size: isMobileStats ? 11 : 13 },
                        bodyFont: { size: isMobileStats ? 10 : 12 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: isMobileStats ? 10 : 12 } },
                        grid: { drawBorder: false, color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: isMobileStats ? 10 : 12 } }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error initializing bar chart:', error);
    }

    /* ==================================================
    LINE CHART
    ================================================== */
    try {
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: @json($bulanLabels),
                datasets: [{
                    label:'Jumlah',
                    data: @json($bulanData),
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239,68,68,0.10)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: isMobileStats ? 3 : 4,
                    pointBorderWidth: 0,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        titleFont: { size: isMobileStats ? 11 : 13 },
                        bodyFont: { size: isMobileStats ? 10 : 12 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: isMobileStats ? 10 : 12 } },
                        grid: { drawBorder: false, color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: isMobileStats ? 10 : 12 } }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error initializing line chart:', error);
    }

    /* ==================================================
    PIE CHART
    ================================================== */
    try {
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: @json(array_column($distribusiData, 'label')),
                datasets: [{
                    data: @json(array_column($distribusiData, 'jumlah')),
                    backgroundColor: [
                        '#22c55e',
                        '#eab308',
                        '#ef4444'
                    ],
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: isMobileStats ? 10 : 12 },
                            padding: isMobileStats ? 10 : 15,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        titleFont: { size: isMobileStats ? 11 : 13 },
                        bodyFont: { size: isMobileStats ? 10 : 12 }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error initializing pie chart:', error);
    }
}

// Initialize charts saat DOM ready
document.addEventListener('DOMContentLoaded', initStatisticsCharts);

</script>
@endsection