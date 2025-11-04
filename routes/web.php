<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\HomepageController;



Route::get('/', function () {
    return view('homepage');
});



// Homepage Routes
Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
Route::get('/about', [HomepageController::class, 'about'])->name('about');
Route::get('/services', [HomepageController::class, 'services'])->name('services');
Route::get('/projects', [HomepageController::class, 'projects'])->name('projects');
Route::get('/contact', [HomepageController::class, 'contact'])->name('contact');
Route::get('/team', [HomepageController::class, 'team'])->name('team');
Route::get('/testimonial', [HomepageController::class, 'testimonial'])->name('testimonial');
Route::get('/features', [HomepageController::class, 'features'])->name('features');
Route::get('/404', [HomepageController::class, 'notFound'])->name('not-found');

// Newsletter Subscription
Route::post('/subscribe', [HomepageController::class, 'subscribe'])->name('subscribe');


Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::resource('warga', WargaController::class);
Route::resource('fasilitas', \App\Http\Controllers\FasilitasUmumController::class);
Route::resource('user', \App\Http\Controllers\UserController::class);


// Route untuk Auth
