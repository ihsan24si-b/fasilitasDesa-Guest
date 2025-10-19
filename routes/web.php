<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasUmumController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fasilitas', [FasilitasController::class, 'index']);

Route::get('/fasilitas', [FasilitasController::class, 'index']);

// Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');


Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('dashboard' ,[DashboardController::class, 'index'])->name('dashboard');

Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/auth/register', [AuthController::class, 'showRegisterForm'])->name('auth.showRegister');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/auth/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register.process');

Route::resource('warga', WargaController::class);
Route::resource('fasilitas', FasilitasUmumController::class);
