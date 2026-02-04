<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// About page
Route::get('/about', function () {
    return view('landing_page.about');
})->name('about');

// Upload routes
Route::get('/upload', [UploadController::class, 'index'])->name('upload.index');
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
Route::get('/upload/result', [UploadController::class, 'result'])->name('upload.result');

// Login route (redirect to admin login)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Admin login routes
Route::get('/admin/login', function () {
    return view('login');
})->name('admin.login');

Route::post('/admin/login', [UploadController::class, 'adminLogin'])->name('admin.login.submit');

// Admin dashboard route
Route::get('/admin/dashboard', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
    }
    return view('Admin.index');
})->name('admin.dashboard');

// Manage admin routes
Route::get('/admin/manage-admin', [AdminController::class, 'index'])->name('admin.manage-admin');
Route::post('/admin/manage-admin', [AdminController::class, 'store'])->name('admin.manage-admin.store');
Route::get('/admin/manage-admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.manage-admin.edit');
Route::put('/admin/manage-admin/{id}', [AdminController::class, 'update'])->name('admin.manage-admin.update');
Route::delete('/admin/manage-admin/{id}', [AdminController::class, 'destroy'])->name('admin.manage-admin.destroy');
Route::patch('/admin/manage-admin/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.manage-admin.toggle-status');

// Classification history route
Route::get('/admin/classification-history', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
    }
    return view('Admin.classification-history');
})->name('admin.classification-history');

// System statistics route
Route::get('/admin/system-statistics', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
    }
    return view('Admin.system-statistics');
})->name('admin.system-statistics');


Route::get('/admin/logout', function () {
    // Clear admin session
    session()->forget(['admin_logged_in', 'admin_user_id', 'admin_name']);
    
    // Redirect to login with success message
    return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
})->name('admin.logout');
