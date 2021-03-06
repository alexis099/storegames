<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JuegoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CompraController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// navegacion principal
Route::get('/', [JuegoController::class, 'principal']);
Route::get('/juego/{id}', [JuegoController::class, 'ver']);
Route::get('/agregar-carrito/{id}', [JuegoController::class, 'agregar_carrito'])->middleware('auth');
Route::get('/eliminar-carrito/{id}', [CarritoController::class, 'destroy'])->middleware('auth');

// usuarios
Route::get('/carrito', [UsuarioController::class, 'carrito'])->middleware('auth');
Route::get('/compras', [CompraController::class, 'index'])->middleware('auth');
Route::get('/pago', [UsuarioController::class, 'pago'])->middleware('auth');
Route::post('/pago', [CompraController::class, 'store'])->middleware('auth');


Route::prefix('admin')->group(function () {
    // juegos
    Route::get('/juego', [JuegoController::class, 'index']);
    Route::get('/juego/agregar', [JuegoController::class, 'create']);
    Route::post('/juego/guardar', [JuegoController::class, 'store']);
    Route::get('/juego/eliminar/{id}', [JuegoController::class, 'store']);
    Route::get('/juego/{id}/imagenes', [JuegoController::class, 'imagenes']);

    // empresas de videojuegos
    Route::get('/empresa', [EmpresaController::class, 'index']);
    Route::get('/empresa/agregar', [EmpresaController::class, 'create']);
    Route::post('/empresa/guardar', [EmpresaController::class, 'store']);
    Route::get('/empresa/eliminar/{id}', [EmpresaController::class, 'destroy']);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
