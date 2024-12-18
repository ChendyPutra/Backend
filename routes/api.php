<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AdminController::class, 'login'])->name('login');
//
// Rute yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    // Admin routes (CRUD)
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('anggaran', AnggaranController::class);
        Route::apiResource('pemasukan', PemasukanController::class);
        Route::apiResource('pengeluaran', PengeluaranController::class);
    });

    // Masyarakat routes (Hanya melihat data)
    Route::middleware('role:masyarakat')->group(function () {
        Route::get('anggaran', [AnggaranController::class, 'index']);
        Route::get('pemasukan', [PemasukanController::class, 'index']);
        Route::get('pengeluaran', [PengeluaranController::class, 'index']);
    });

    // Admin logout
    Route::post('logout', [AdminController::class, 'logout']);
});
