<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ServicioApiController;
use App\Http\Controllers\Api\CitaApiController;

// Rutas Públicas (sin autenticación)
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

// Servicios públicos
Route::get('/servicios', [ServicioApiController::class, 'index']);
Route::get('/servicios/{id}', [ServicioApiController::class, 'show']);

// Rutas Protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->group(function () {
    // Autenticación
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/profile', [AuthApiController::class, 'profile']);
    
    // Citas
    Route::get('/citas', [CitaApiController::class, 'index']);
    Route::post('/citas', [CitaApiController::class, 'store']);
    Route::get('/citas/{id}', [CitaApiController::class, 'show']);
    Route::delete('/citas/{id}', [CitaApiController::class, 'destroy']);
});