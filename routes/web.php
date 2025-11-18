<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\JenisSuratController;

// Route untuk halaman utama
Route::get('/', function () {
    return view('dashboard'); // atau 'home' - SESUAIKAN dengan nama file
})->name('home');

// Route untuk dashboard admin
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/about', function () {
    return view('pages.halaman.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.halaman.contact');
})->name('contact');

Route::get('/service', function () {
    return view('pages.halaman.service');
})->name('service');

Route::get('/feature', function () {
    return view('pages.halaman.feature');
})->name('feature');

Route::get('/team', function () {
    return view('pages.halaman.team');
})->name('team');

Route::get('/project', function () {
    return view('pages.halaman.project');
})->name('project');
// 
Route::get('/testimonial', function () {
    return view('pages.halaman.testimonial');
})->name('testimonial');

// CRUD Routes - ✅ SUDAH BENAR
Route::resource('warga', WargaController::class);
Route::resource('jenis-surat', JenisSuratController::class);
Route::resource('user', UserController::class);
