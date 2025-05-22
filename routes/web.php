<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PenyimpananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LogController;

// Login
Route::get('/', [HomeController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Tambahkan agar GET /login redirect ke halaman utama (landing page)
Route::get('/login', function () {
    return redirect('/');
})->name('login-redirect');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

// Register routes
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::resource('barang', BarangController::class);
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::resource('penyimpanan', PenyimpananController::class);
Route::resource('user', PenggunaController::class);
// Route::resource('/log-aktivitas', LogController::class);
Route::get('/log-aktivitas', [LogController::class, 'index'])->name('log.index');


// Route::post('/rekomendasi-lokasi', [PenyimpananController::class, 'rekomendasiLokasi']);
Route::post('/rekomendasi-lokasi', [PenyimpananController::class, 'rekomendasiLokasi'])->name('penyimpanan.rekomendasi');
// Route::post('/penyimpanan/rekomendasi-lokasi', [PenyimpananController::class, 'rekomendasiLokasi']);
// Route::post('/penyimpanan/manual-placement', [PenyimpananController::class, 'storePlacement'])->name('penyimpanan.manualPlacement');
Route::post('/penyimpanan/manual-placement', [PenyimpananController::class, 'storePlacement']);
Route::post('/penyimpanan/hapus-barang', [PenyimpananController::class, 'removePlacement'])->name('penyimpanan.removePlacement');
