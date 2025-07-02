<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Frontend\HomeController;

// Import Controller untuk Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\PertemuanController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\RiwayatSiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =====================================================================
// [BARU] RUTE UNTUK PENGUNJUNG (FRONT-END)
// =====================================================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// =====================================================================
// RUTE AUTENTIKASI & PROFIL (DARI BREEZE)
// =====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Jembatan setelah login
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// =====================================================================
// GRUP UNTUK SEMUA HALAMAN PANEL ADMIN
// =====================================================================
Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->name('admin.')
    ->group(function () {
    
    // 1. Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. CRUD untuk Data Master
    Route::resource('kelas', KelasController::class);
    Route::resource('siswa', SiswaController::class);

    // 3. Alur Kerja Utama: Pertemuan & Absensi
    Route::get('pertemuan/create', [PertemuanController::class, 'create'])->name('pertemuan.create');
    Route::post('pertemuan', [PertemuanController::class, 'store'])->name('pertemuan.store');
    
    Route::get('absensi/{pertemuan}/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('absensi/{pertemuan}', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('pertemuan', [PertemuanController::class, 'index'])->name('pertemuan.index');
    Route::get('absensi/{pertemuan}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::put('absensi/{pertemuan}', [AbsensiController::class, 'update'])->name('absensi.update');
    
    // 4. Halaman Laporan & Pembayaran
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('siswa/{siswa}/riwayat', [RiwayatSiswaController::class, 'index'])->name('siswa.riwayat');
});


// Rute Autentikasi dari Laravel Breeze (Login, Register, dll)
require __DIR__.'/auth.php';