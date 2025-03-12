<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('designations', DesignationController::class)->except(['show', 'destroy']);
    Route::resource('users', UserController::class)->except(['show', 'destroy']);
});


// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::resource('designations', DesignationController::class)->except(['show', 'destroy']);


// Route::resource('users', UserController::class)->except(['show', 'destroy']);
























// Route::get('/', function () {
//     return redirect()->route('login');
// });
//  Auth::routes();

// Protected routes
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
//     // Designation routes
//     Route::resource('designations', DesignationController::class)->except(['show', 'destroy']);
    
//     // User routes
//     Route::resource('users', UserController::class)->except(['show', 'destroy']);
// });


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
