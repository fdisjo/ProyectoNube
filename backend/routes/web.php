<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\VentasController;

// Redireccionar la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas públicas (Autenticación)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas (Punto de Venta) - Solo accesibles tras iniciar sesión
Route::middleware(['auth'])->group(function () {
    Route::get('/pos', [ProductosController::class, 'index'])->name('pos.index');
    Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');
    Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');
    Route::get('/historial', [VentasController::class, 'historial'])->name('ventas.historial');
});