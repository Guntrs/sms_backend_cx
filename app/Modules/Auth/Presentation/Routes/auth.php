<?php

use App\Modules\Auth\Presentation\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rutas públicas — no requieren token
Route::prefix('api/v1/auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

// Rutas protegidas — requieren token Sanctum
Route::prefix('api/v1/auth')->middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me',     [AuthController::class, 'me']);
});
