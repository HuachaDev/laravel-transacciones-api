<?php

namespace App\Http\Controllers;

use App\Models\CuentaFinanciera;
use Illuminate\Http\Request;

class TransaccionController extends Controller
{
  // Procesar transferencias
  public function transferir(Request $request,  $id)
  {
    $request->validate([
        'cuentaDestinoId' => 'required|exists:cuentas_financieras,id',
        'monto' => 'required|numeric|min:0'
    ]);


    $cuentaOrigen = CuentaFinanciera::findOrFail($id);
    $cuentaDestino = CuentaFinanciera::findOrFail($request->cuentaDestinoId);

    $comision = $cuentaOrigen->tipoCuenta->id === 1 ? $request->monto * 0.01 : 0; 
    $totalTransferencia = $request->monto + $comision;

    if ($cuentaOrigen->saldo < $totalTransferencia) {
        return response()->json(['error' => 'Fondos insuficientes'], 400);
    }

    if ($cuentaOrigen->tipoCuenta->id === 1 && ($cuentaOrigen->saldo - $request->monto) < 100) {
        return response()->json(['error' => 'Saldo mínimo no permitido'], 400);
    }

    $cuentaOrigen->saldo -= $totalTransferencia;
    $cuentaDestino->saldo += $request->monto;

    $transaccionOrigen = $cuentaOrigen->transacciones()->create([
        'tipo_transaccion_id' => 3, 
        'cuenta_id' => $cuentaOrigen->id,
        'monto' => $totalTransferencia,
        'fecha' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $transaccionDestino = $cuentaDestino->transacciones()->create([
        'tipo_transaccion_id' => 1, 
        'cuenta_id' => $cuentaDestino->id,
        'monto' => $request->monto,
        'fecha' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $cuentaOrigen->save();
    $cuentaDestino->save();

    return response()->json([
        'id' => $cuentaOrigen->id,
        'saldo' => $cuentaOrigen->saldo,
        'transaccionRealizada' => [
            'tipo' => $transaccionOrigen->tipoTransaccion->nombre,
            'monto' => $transaccionDestino->monto,
            'titularCuenta' => $cuentaDestino->titularCuenta,
            'fecha' => $transaccionOrigen->created_at->format('Y-m-d H:i:s'),
        ],
    ]);
      

  }
}
