<?php

namespace App\Http\Controllers; // ✅ bukan Admin\

use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Models\Prediction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller // ✅ nama class sesuai nama file
{
    public function index()
{
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $modelAccuracy = 92.62; // ✅ hardcode akurasi model

    $total = Upload::count();
    $today = Upload::whereDate('created_at', today())->count();

    $trend = Upload::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $distribution = Upload::select('category', DB::raw('count(*) as total'))
        ->groupBy('category')
        ->get();

    $totalAdmin = User::where('role', 'admin')->count();

    return view('Admin.index', compact(
        'total',
        'today',
        'trend',
        'distribution',
        'totalAdmin',
        'modelAccuracy'
    ));
}
}