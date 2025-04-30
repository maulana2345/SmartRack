<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardHistoryController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\KoiDetectionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

// Register routes
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/barang', [BarangController::class, 'index'])->name('barang');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');