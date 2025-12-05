<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasUmumController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIC / AUTH (Tidak dijaga Middleware)
|--------------------------------------------------------------------------
| Bagian ini HARUS di luar middleware 'checkislogin' agar tidak looping.
*/
Route::prefix('pages/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('pages.auth.index');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('pages.auth.register.form');
    Route::post('/login', [AuthController::class, 'login'])->name('pages.auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('pages.auth.register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('pages.auth.logout');
});

/*
|--------------------------------------------------------------------------
| 2. ROUTE PRIVATE / ADMIN (Dijaga Middleware 'checkislogin')
|--------------------------------------------------------------------------
| User harus login dulu baru bisa akses route di dalam grup ini.
*/
Route::group(['middleware' => ['checkislogin']], function () {

    // Redirect root URL ke Dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::prefix('pages/profile')->group(function () {
        Route::get('/show', [ProfileController::class, 'show'])->name('pages.profile.show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('pages.profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('pages.profile.update');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('pages.profile.destroy');
    });

    // ====================================================
    // CRUD Resource (User, Warga, Fasilitas)
    // ====================================================

    // 1. DATA USER (Hanya bisa diakses oleh Super Admin)
    Route::resource('pages/user', UserController::class)->names([
        'index'   => 'pages.user.index',
        'create'  => 'pages.user.create',
        'store'   => 'pages.user.store',
        'show'    => 'pages.user.show',
        'edit'    => 'pages.user.edit',
        'update'  => 'pages.user.update',
        'destroy' => 'pages.user.destroy'
    ])->middleware('checkrole:Super Admin');

    // 2. DATA WARGA
    Route::resource('pages/warga', WargaController::class)->names([
        'index'   => 'pages.warga.index',
        'create'  => 'pages.warga.create',
        'store'   => 'pages.warga.store',
        'show'    => 'pages.warga.show',
        'edit'    => 'pages.warga.edit',
        'update'  => 'pages.warga.update',
        'destroy' => 'pages.warga.destroy'
    ]);

    // 3. DATA FASILITAS
    Route::resource('pages/fasilitas', FasilitasUmumController::class)->names([
        'index'   => 'pages.fasilitas.index',
        'create'  => 'pages.fasilitas.create',
        'store'   => 'pages.fasilitas.store',
        'show'    => 'pages.fasilitas.show',
        'edit'    => 'pages.fasilitas.edit',
        'update'  => 'pages.fasilitas.update',
        'destroy' => 'pages.fasilitas.destroy'
    ]);

});
