<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\FasilitasUmumController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE UTAMA (PUBLIC & DASHBOARD)
|--------------------------------------------------------------------------
| Route ini menangani halaman depan sekaligus dashboard admin.
| Logika pemisahan tampilan ada di Controller & View.
*/
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| 2. OTENTIKASI
|--------------------------------------------------------------------------
*/
Route::prefix('pages/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login'); 
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); 
    Route::post('/login', [AuthController::class, 'login'])->name('pages.auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('pages.auth.register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('pages.auth.logout');
});

/*
|--------------------------------------------------------------------------
| 3. ROUTE PRIVATE (Harus Login)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['checkislogin']], function () {

    // --- Profile & Developer ---
    Route::prefix('pages/profile')->group(function () {
        Route::get('/show', [ProfileController::class, 'show'])->name('pages.profile.show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('pages.profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('pages.profile.update');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('pages.profile.destroy');
    });
    Route::get('pages/developer', [DeveloperController::class, 'index'])->name('pages.developer.index');

    // --- Super Admin ---
    Route::group(['middleware' => ['checkrole:Super Admin']], function () {
        Route::resource('pages/user', UserController::class)->names('pages.user');
    });

    // --- Admin & Super Admin ---
    Route::group(['middleware' => ['checkrole:Super Admin,Admin']], function () {
        Route::resource('pages/warga', WargaController::class)->names('pages.warga');
        Route::resource('pages/petugas', PetugasController::class)->names('pages.petugas');
        Route::patch('pages/peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus'])->name('pages.peminjaman.update-status');
        Route::resource('pages/pembayaran', PembayaranController::class)->names('pages.pembayaran');
    });

    // --- Semua Role (Termasuk Warga & Petugas) ---
    // Fasilitas & Peminjaman (Create/Show boleh semua, Edit/Delete dibatasi di controller)
    Route::resource('pages/fasilitas', FasilitasUmumController::class)->names('pages.fasilitas');
    Route::resource('pages/peminjaman', PeminjamanController::class)->names('pages.peminjaman');
});