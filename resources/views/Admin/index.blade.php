@extends('Admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="mb-6 md:mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1 md:mb-2">Dashboard</h1>
    <p class="text-sm md:text-base text-gray-600">
        Selamat datang di dashboard sistem klasifikasi tomat
    </p>
</div>

<!-- CARD - Responsive Grid -->
<div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mb-6 md:mb-8">

    <!-- Total -->
    <div class="stat-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-3 md:p-6">
        <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg md:rounded-xl flex items-center justify-center mb-2 md:mb-4">
            <i class="fas fa-chart-bar text-blue-600 text-lg md:text-xl"></i>
        </div>

        <h3 class="text-xl md:text-2xl font-bold text-gray-900">{{ $total }}</h3>
        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">Total Klasifikasi</p>
    </div>

    <!-- Akurasi -->
    <div class="stat-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-3 md:p-6">
        <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-100 rounded-lg md:rounded-xl flex items-center justify-center mb-2 md:mb-4">
            <i class="fas fa-bullseye text-purple-600 text-lg md:text-xl"></i>
        </div>

        <h3 class="text-xl md:text-2xl font-bold text-gray-900">{{ $modelAccuracy }}%</h3>
        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">Akurasi Model</p>
    </div>

    <!-- Admin -->
    <div class="stat-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-3 md:p-6">
        <div class="w-10 h-10 md:w-12 md:h-12 bg-orange-100 rounded-lg md:rounded-xl flex items-center justify-center mb-2 md:mb-4">
            <i class="fas fa-users text-orange-600 text-lg md:text-xl"></i>
        </div>

        <h3 class="text-xl md:text-2xl font-bold text-gray-900">{{ $totalAdmin }}</h3>
        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">Admin Aktif</p>
    </div>

    <!-- Hari Ini -->
    <div class="stat-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-3 md:p-6">
        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-lg md:rounded-xl flex items-center justify-center mb-2 md:mb-4">
            <i class="fas fa-calendar-day text-green-600 text-lg md:text-xl"></i>
        </div>

        <h3 class="text-xl md:text-2xl font-bold text-gray-900">{{ $today }}</h3>
        <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2">Klasifikasi Hari Ini</p>
    </div>

</div>


<!-- CHART - Responsive Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">

    <!-- Trend -->
    <div class="chart-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-4 md:p-6">
        <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-1 md:mb-2">
            Trend Klasifikasi
        </h2>

        <p class="text-xs md:text-sm text-gray-600 mb-4 md:mb-6">
            Jumlah klasifikasi dalam 7 hari terakhir
        </p>

        <div class="chart-container" style="height: 250px;">
            <canvas id="trendChart"></canvas>
        </div>
    </div>

    <!-- Pie -->
    <div class="chart-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-4 md:p-6">
        <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-1 md:mb-2">
            Distribusi Klasifikasi
        </h2>

        <p class="text-xs md:text-sm text-gray-600 mb-4 md:mb-6">
            Persentase kategori kematangan tomat
        </p>

        <div class="chart-container" style="height: 250px;">
            <canvas id="distributionChart"></canvas>
        </div>
    </div>

</div>

@endsection



@section('scripts')
<script>

// Tunggu sampai Chart.js library loaded
function initCharts() {
    if (typeof Chart === 'undefined') {
        console.warn('Chart.js belum loaded, retry dalam 100ms');
        setTimeout(initCharts, 100);
        return;
    }

    /* =========================
    TREND LINE
    ========================= */
    const trendLabels = @json(
        $trend->pluck('date')->map(fn($d) =>
            \Carbon\Carbon::parse($d)->translatedFormat('D')
        )
    );

    const trendData = @json($trend->pluck('total'));

    // Optimize for mobile
    const isMobile = window.innerWidth < 768;

    try {
        new Chart(document.getElementById('trendChart'), {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [{
                    data: trendData,
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239,68,68,0.10)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: isMobile ? 3 : 5,
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
                    filler: { propagate: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { drawBorder: false, color: 'rgba(0,0,0,0.05)' },
                        ticks: { font: { size: isMobile ? 10 : 12 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: isMobile ? 10 : 12 } }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error initializing trend chart:', error);
    }

    /* =========================
    PIE CHART
    ========================= */
    const distLabels = @json(
        $distribution->pluck('category')->map(
            fn($c) => ucfirst(str_replace('_',' ',$c))
        )
    );

    const distData = @json($distribution->pluck('total'));

    const dynamicColors = distLabels.map(label => {
        if (label.toLowerCase() === 'matang') {
            return '#ef4444'; // merah
        } 
        else if (label.toLowerCase() === 'mentah') {
            return '#22c55e'; // hijau
        } 
        else {
            return '#f59e0b'; // kuning/orange
        }
    });

    try {
        new Chart(document.getElementById('distributionChart'), {
            type: 'pie',
            data: {
                labels: distLabels,
                datasets: [{
                    data: distData,
                    backgroundColor: dynamicColors,
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: isMobile ? 'bottom' : 'bottom',
                        labels: {
                            font: { size: isMobile ? 10 : 12 },
                            padding: isMobile ? 10 : 15,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        titleFont: { size: isMobile ? 11 : 13 },
                        bodyFont: { size: isMobile ? 10 : 12 }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error initializing distribution chart:', error);
    }
}

// Initialize charts saat DOM ready
document.addEventListener('DOMContentLoaded', initCharts);

</script>
@endsection