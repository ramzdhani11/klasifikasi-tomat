<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('welcome');
});

// About page
Route::get('/about', function () {
    return view('about');
});

// Upload routes
Route::get('/upload', [UploadController::class, 'index'])->name('upload.index');
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
Route::get('/upload/result', [UploadController::class, 'result'])->name('upload.result');

// Admin login routes
Route::get('/admin/login', function () {
    return view('login');
})->name('admin.login');

Route::post('/admin/login', [UploadController::class, 'adminLogin'])->name('admin.login.submit');

// Admin dashboard route
Route::get('/admin/dashboard', function () {
    return view('Admin.index');
})->name('admin.dashboard');

// Manage admin route
Route::get('/admin/manage-admin', function () {
    return view('Admin.manage-admin');
})->name('admin.manage-admin');


Route::get('/admin/logout', function () {
    return view('Admin.logout');
})->name('admin.logout');
