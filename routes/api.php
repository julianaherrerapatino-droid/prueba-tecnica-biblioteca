<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LibroController;
use App\Http\Controllers\Api\PrestamoController;

Route::apiResource('libros', LibroController::class);

Route::get('prestamos', [PrestamoController::class, 'index']);
Route::post('prestamos', [PrestamoController::class, 'store']);
Route::put('prestamos/{id}/devolver', [PrestamoController::class, 'devolver']);
