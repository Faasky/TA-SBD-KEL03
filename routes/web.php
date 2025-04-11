<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PemeliharaanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PinjamBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route publik
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

    // Rute untuk registrasi
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
});

// Protected routes (Hanya untuk pengguna yang sudah login)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Kategori
    Route::resource('kategori', KategoriController::class);
    Route::put('/kategori/{kategori}/soft-delete', [KategoriController::class, 'softDelete'])->name('kategori.soft-delete');

    // Manajemen Barang
    Route::resource('barang', BarangController::class);
    Route::put('/barang/{barang}/soft-delete', [BarangController::class, 'softDelete'])->name('barang.soft-delete');

    // Manajemen Karyawan (khusus admin)
    Route::get('/karyawan/trash', [KaryawanController::class, 'trash'])->name('karyawan.trash');
   
    Route::resource('karyawan', KaryawanController::class);
    Route::post('/karyawan/{karyawan}/soft-delete', [KaryawanController::class, 'softDelete'])->name('karyawan.softDelete');
    Route::post('/karyawan/{id}/restore', [KaryawanController::class, 'restore'])->name('karyawan.restore');
    Route::delete('/karyawan/{id}/delete-permanent', [KaryawanController::class, 'destroy'])->name('karyawan.deletePermanent');
    

    // Manajemen Peminjaman
    Route::resource('peminjaman', PeminjamanController::class);
    Route::put('/peminjaman/{peminjaman}/soft-delete', [PeminjamanController::class, 'softDelete'])->name('peminjaman.soft-delete');

    // Manajemen Pemeliharaan Barang
    Route::resource('pemeliharaan', PemeliharaanController::class);
    Route::put('/pemeliharaan/{pemeliharaan}/soft-delete', [PemeliharaanController::class, 'softDelete'])->name('pemeliharaan.soft-delete');

    // Manajemen Pinjam Barang
    Route::resource('pinjam_barang', PinjamBarangController::class);
    Route::put('/pinjam_barang/{pinjamBarang}/soft-delete', [PinjamBarangController::class, 'softDelete'])->name('pinjam_barang.soft-delete');
});
