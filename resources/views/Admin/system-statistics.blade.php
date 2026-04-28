@extends('Admin.layouts.app')

@section('title', 'Statistik Sistem')
@section('page-title', 'Statistik Sistem')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Statistik Sistem</h1>
    <p class="text-gray-600">
        Pantau performa dan statistik sistem klasifikasi tomat
    </p>
</div>

<!-- =======================================================
CARD SUMMARY
======================================================= -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- TOTAL -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">

            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-chart-bar text-blue-600 text-xl"></i>
            </div>

            <span class="text-xs font-medium px-2 py-1 rounded-full
                {{ $pctTotal >= 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }}">
                {{ $pctTotal >= 0 ? '+' : '' }}{{ $pctTotal }}%
            </span>
        </div>

        <h3 class="text-3xl font-bold text-gray-900">
            {{ number_format($totalKlasifikasi) }}
        </h3>

        <p class="text-sm text-gray-600 mt-2">
            Total Klasifikasi
        </p>
    </div>

    <!-- HARI INI -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">

            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-calendar-day text-green-600 text-xl"></i>
            </div>

            <span class="text-xs font-medium px-2 py-1 rounded-full
                {{ $pctHariIni >= 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }}">
                {{ $pctHariIni >= 0 ? '+' : '' }}{{ $pctHariIni }}%
            </span>
        </div>

        <h3 class="text-3xl font-bold text-gray-900">
            {{ number_format($klasifikasiHariIni) }}
        </h3>

        <p class="text-sm text-gray-600 mt-2">
            Klasifikasi Hari Ini
        </p>
    </div>

    <!-- AKURASI -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">

            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-bullseye text-purple-600 text-xl"></i>
            </div>

            <span class="text-xs text-gray-600 font-medium bg-gray-50 px-2 py-1 rounded-full">
                MODEL
            </span>
        </div>

        <h3 class="text-3xl font-bold text-gray-900">
            {{ number_format($akurasiRataRata, 2) }}%
        </h3>

        <p class="text-sm text-gray-600 mt-2">
            Akurasi Model
        </p>
    </div>

    <!-- ADMIN -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">

            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-users text-orange-600 text-xl"></i>
            </div>

            <span class="text-xs text-gray-600 font-medium bg-gray-50 px-2 py-1 rounded-full">
                ADMIN
            </span>
        </div>

        <h3 class="text-3xl font-bold text-gray-900">
            {{ $penggunaAktifAdmin }}
        </h3>

        <p class="text-sm text-gray-600 mt-2">
            Pengguna Aktif Admin
        </p>
    </div>

</div>


<!-- =======================================================
CHARTS
======================================================= -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- BAR -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <h2 class="text-lg font-semibold text-gray-900 mb-2">
            Jumlah Klasifikasi Harian
        </h2>

        <p class="text-sm text-gray-600 mb-6">
            Statistik klasifikasi 7 hari terakhir
        </p>

        <div style="height:320px">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <!-- LINE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <h2 class="text-lg font-semibold text-gray-900 mb-2">
            Tren Klasifikasi Bulanan
        </h2>

        <p class="text-sm text-gray-600 mb-6">
            Statistik klasifikasi 12 bulan terakhir
        </p>

        <div style="height:320px">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

</div>



<!-- =======================================================
PIE CHART DATASET
======================================================= -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

    <h2 class="text-lg font-semibold text-gray-900 mb-2">
        Distribusi Dataset Training Tomat
    </h2>

    <p class="text-sm text-gray-600 mb-6">
        Berdasarkan dataset asli model klasifikasi
    </p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- PIE -->
        <div style="height:340px">
            <canvas id="pieChart"></canvas>
        </div>

        <!-- LEGEND -->
        <div class="flex items-center justify-center">
            <div class="space-y-5 w-full max-w-sm">

                @foreach($distribusiData as $item)

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="w-4 h-4 rounded-full
                            {{ $loop->index == 0 ? 'bg-green-500' : ($loop->index == 1 ? 'bg-yellow-500' : 'bg-red-500') }}">
                        </div>

                        <span class="text-sm text-gray-700">
                            {{ $item['label'] }}
                        </span>
                    </div>

                    <div class="text-right">
                        <div class="text-sm font-semibold text-gray-900">
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

/* ==================================================
BAR CHART
================================================== */
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: @json($hariLabels),
        datasets: [{
            label: 'Jumlah',
            data: @json($hariData),
            backgroundColor: '#ef4444',
            borderRadius: 8,
            barThickness: 34
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display:false }
        },
        scales: {
            y: {
                beginAtZero:true,
                ticks:{ precision:0 }
            },
            x: {
                grid:{ display:false }
            }
        }
    }
});


/* ==================================================
LINE CHART
================================================== */
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
            pointRadius: 4,
            pointHoverRadius: 6
        }]
    },
    options: {
        responsive:true,
        maintainAspectRatio:false,
        plugins:{
            legend:{ display:false }
        },
        scales:{
            y:{
                beginAtZero:true,
                ticks:{ precision:0 }
            },
            x:{ grid:{ display:false } }
        }
    }
});


/* ==================================================
PIE CHART
================================================== */
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
            borderWidth: 0
        }]
    },
    options: {
        responsive:true,
        maintainAspectRatio:false,
        plugins:{
            legend:{ display:false }
        }
    }
});

</script>
@endsection