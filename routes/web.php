<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\Admin\JenisSuratController;

// Route untuk halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Warga
    Route::resource('warga', WargaController::class);

    // CRUD Jenis Surat
    Route::resource('jenis-surat', JenisSuratController::class);
});
