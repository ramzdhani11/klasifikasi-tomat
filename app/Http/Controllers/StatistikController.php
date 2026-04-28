<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | SAMAKAN DENGAN DASHBOARD
        |--------------------------------------------------------------------------
        | Dashboard memakai tabel Upload
        | Maka Statistik juga harus memakai Upload
        |--------------------------------------------------------------------------
        */

        // Total klasifikasi
        $totalKlasifikasi = Upload::count();

        // Hari ini
        $klasifikasiHariIni = Upload::whereDate(
            'created_at',
            Carbon::today()
        )->count();

        // Jumlah admin
        $penggunaAktifAdmin = User::where('role', 'admin')->count();

        // Akurasi model
        $akurasiRataRata = 92.62;

        /*
        |--------------------------------------------------------------------------
        | PERSENTASE KENAIKAN
        |--------------------------------------------------------------------------
        */

        $kemarin = Upload::whereDate(
            'created_at',
            Carbon::yesterday()
        )->count();

        $pctHariIni = $kemarin > 0
            ? round((($klasifikasiHariIni - $kemarin) / $kemarin) * 100, 1)
            : 0;

        $bulanIni = Upload::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $bulanLalu = Upload::whereMonth(
                'created_at',
                now()->subMonth()->month
            )
            ->whereYear(
                'created_at',
                now()->subMonth()->year
            )
            ->count();

        $pctTotal = $bulanLalu > 0
            ? round((($bulanIni - $bulanLalu) / $bulanLalu) * 100, 1)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | GRAFIK BAR 7 HARI
        |--------------------------------------------------------------------------
        */

        $hariLabels = [];
        $hariData   = [];

        $namaHari = [
            'Min', 'Sen', 'Sel',
            'Rab', 'Kam', 'Jum', 'Sab'
        ];

        for ($i = 6; $i >= 0; $i--) {

            $tgl = Carbon::today()->subDays($i);

            $hariLabels[] = $namaHari[$tgl->dayOfWeek];

            $hariData[] = Upload::whereDate(
                'created_at',
                $tgl
            )->count();
        }

        /*
        |--------------------------------------------------------------------------
        | GRAFIK LINE 12 BULAN
        |--------------------------------------------------------------------------
        */

        $bulanLabels = [];
        $bulanData   = [];

        $namaBulan = [
            'Jan', 'Feb', 'Mar', 'Apr',
            'Mei', 'Jun', 'Jul', 'Agu',
            'Sep', 'Okt', 'Nov', 'Des'
        ];

        for ($i = 11; $i >= 0; $i--) {

            $tgl = Carbon::now()
                ->startOfMonth()
                ->subMonths($i);

            $bulanLabels[] = $namaBulan[$tgl->month - 1];

            $bulanData[] = Upload::whereMonth(
                    'created_at',
                    $tgl->month
                )
                ->whereYear(
                    'created_at',
                    $tgl->year
                )
                ->count();
        }

        /*
        |--------------------------------------------------------------------------
        | PIE CHART DATASET TRAINING
        |--------------------------------------------------------------------------
        */

        $datasetTomat = [
            'mentah'          => 232,
            'setengah_matang' => 402,
            'matang'          => 341,
        ];

        $totalDataset = array_sum($datasetTomat);

        $distribusiData = [];

        foreach ($datasetTomat as $label => $jumlah) {

            $distribusiData[] = [
                'label' => ucfirst(str_replace('_', ' ', $label)),
                'jumlah' => $jumlah,
                'persentase' => round(
                    ($jumlah / $totalDataset) * 100,
                    1
                ),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('Admin.system-statistics', compact(
            'totalKlasifikasi',
            'klasifikasiHariIni',
            'akurasiRataRata',
            'penggunaAktifAdmin',
            'pctHariIni',
            'pctTotal',
            'hariLabels',
            'hariData',
            'bulanLabels',
            'bulanData',
            'distribusiData'
        ));
    }
}