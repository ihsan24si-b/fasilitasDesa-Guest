<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fasilitas', [FasilitasController::class, 'index']);

Route::get('/fasilitas', [FasilitasController::class, 'index']);

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');


Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
