<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::post('/api/login', [AuthController::class, 'login']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
