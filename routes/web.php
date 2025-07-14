<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::post('/api/login', [AuthController::class, 'login']);
Route::middleware(['jwt.auth'])->group(function () {
    // API routes only, e.g.:
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
