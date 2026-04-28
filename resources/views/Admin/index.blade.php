@extends('Admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard</h1>
    <p class="text-gray-600">
        Selamat datang di dashboard sistem klasifikasi tomat
    </p>
</div>

<!-- CARD -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- Total -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
            <i class="fas fa-chart-bar text-blue-600 text-xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900">{{ $total }}</h3>
        <p class="text-sm text-gray-600 mt-2">Total Klasifikasi</p>
    </div>

    <!-- Akurasi -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
            <i class="fas fa-bullseye text-purple-600 text-xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900">{{ $modelAccuracy }}%</h3>
        <p class="text-sm text-gray-600 mt-2">Akurasi Model</p>
    </div>

    <!-- Admin -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
            <i class="fas fa-users text-orange-600 text-xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900">{{ $totalAdmin }}</h3>
        <p class="text-sm text-gray-600 mt-2">Admin Aktif</p>
    </div>

    <!-- Hari Ini -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
            <i class="fas fa-calendar-day text-green-600 text-xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900">{{ $today }}</h3>
        <p class="text-sm text-gray-600 mt-2">Klasifikasi Hari Ini</p>
    </div>

</div>


<!-- CHART -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Trend -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">
            Trend Klasifikasi
        </h2>

        <p class="text-sm text-gray-600 mb-6">
            Jumlah klasifikasi dalam 7 hari terakhir
        </p>

        <div style="height:320px">
            <canvas id="trendChart"></canvas>
        </div>
    </div>

    <!-- Pie -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">
            Distribusi Klasifikasi
        </h2>

        <p class="text-sm text-gray-600 mb-6">
            Persentase kategori kematangan tomat
        </p>

        <div style="height:320px">
            <canvas id="distributionChart"></canvas>
        </div>
    </div>

</div>

@endsection



@section('scripts')
<script>

/* =========================
TREND LINE
========================= */
const trendLabels = @json(
    $trend->pluck('date')->map(fn($d) =>
        \Carbon\Carbon::parse($d)->translatedFormat('D')
    )
);

const trendData = @json($trend->pluck('total'));

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
            pointRadius: 5
        }]
    },
    options: {
        responsive:true,
        maintainAspectRatio:false,
        plugins:{
            legend:{display:false}
        },
        scales:{
            y:{beginAtZero:true},
            x:{grid:{display:false}}
        }
    }
});


/* =========================
PIE CHART
========================= */
const distLabels = @json(
    $distribution->pluck('category')->map(
        fn($c) => ucfirst(str_replace('_',' ',$c))
    )
);

const distData = @json($distribution->pluck('total'));

/*
Warna berdasarkan label:
matang = merah
mentah = hijau
setengah matang = kuning
*/

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

new Chart(document.getElementById('distributionChart'), {
    type: 'pie',
    data: {
        labels: distLabels,
        datasets: [{
            data: distData,
            backgroundColor: dynamicColors,
            borderWidth: 1
        }]
    },
    options:{
        responsive:true,
        maintainAspectRatio:false,
        plugins:{
            legend:{
                position:'bottom'
            }
        }
    }
});

</script>
@endsection