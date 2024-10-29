<?php

use App\Http\Controllers\DepositController;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [DepositController::class, 'index'])->name(name: 'dashboard');