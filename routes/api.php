<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaFinancieraController;
use App\Http\Controllers\TransaccionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

// Rutas para Cuenta Financiera
Route::get('cuentas', [CuentaFinancieraController::class, 'index']); // Listar todas las cuentas
Route::get('cuentas/{id}', [CuentaFinancieraController::class, 'show']); // Ver detalles de una cuenta
Route::post('cuentas/{id}/depositar', [CuentaFinancieraController::class, 'depositar']); // Realizar depósito
Route::post('cuentas/{id}/retirar', [CuentaFinancieraController::class, 'retirar']); // Realizar retiro

// Rutas para Transacciones

Route::post('cuentas/{id}/transferir', [TransaccionController::class, 'transferir']);

