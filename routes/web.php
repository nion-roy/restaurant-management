<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('app');
});

Route::post('/api/login', [AuthController::class, 'login']);
