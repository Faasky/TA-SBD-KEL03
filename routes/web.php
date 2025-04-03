<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PemeliharaanController;
use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route publik
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    
    // Rute untuk registrasi
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
});

// Protected routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kategori
    Route::resource('kategori', KategoriController::class);
    Route::put('/kategori/{kategori}/soft-delete', [KategoriController::class, 'softDelete'])->name('kategori.soft-delete');
    
    // Barang
    Route::resource('barang', BarangController::class);
    Route::put('/barang/{barang}/soft-delete', [BarangController::class, 'softDelete'])->name('barang.soft-delete');
    
    // Karyawan (untuk admin)
        Route::resource('karyawan', KaryawanController::class);
        Route::put('/karyawan/{karyawan}/soft-delete', [KaryawanController::class, 'softDelete'])->name('karyawan.soft-delete');
    
    // Peminjaman
    Route::resource('peminjaman', PeminjamanController::class);
    Route::put('/peminjaman/{peminjaman}/soft-delete', [PeminjamanController::class, 'softDelete'])->name('peminjaman.soft-delete');
    
    // Pemeliharaan
    Route::resource('pemeliharaan', PemeliharaanController::class);
    Route::put('/pemeliharaan/{pemeliharaan}/soft-delete', [PemeliharaanController::class, 'softDelete'])->name('pemeliharaan.soft-delete');

});