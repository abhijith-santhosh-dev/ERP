<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('designations', DesignationController::class)->except(['show', 'destroy']);
    Route::resource('users', UserController::class)->except(['show', 'destroy']);

























