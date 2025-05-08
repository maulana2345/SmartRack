<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardHistoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PenyimpananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LogController;

Route::get('/', [HomeController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });

// Login routes
// Route::controller(LoginController::class)->group(function () {
//     Route::get('/login', 'index')->name('login')->middleware('guest');
//     Route::post('/login', 'authenticate');
//     Route::get('/logout', 'logout');
// });

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Tambahkan agar GET /login redirect ke halaman utama (landing page)
Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
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
Route::resource('log', LogController::class);
