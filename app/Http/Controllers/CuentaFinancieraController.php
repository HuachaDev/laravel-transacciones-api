<?php

namespace App\Http\Controllers;

use App\Models\CuentaFinanciera;
use Illuminate\Http\Request;

class CuentaFinancieraController extends Controller
{
  
   public function index()
   {

       $cuentas = CuentaFinanciera::with('tipoCuenta:id,nombre')->get(['id', 'saldo', 'titularCuenta']);
       return response()->json($cuentas->map(function ($cuenta) {
           return [
               'id' => $cuenta->id,
               'saldo' => $cuenta->saldo,
               'titularCuenta' => $cuenta->titularCuenta,
           ];
       }));
   }


   public function show($id)
   {


       $cuenta = CuentaFinanciera::with(['tipoCuenta', 'transacciones'])->findOrFail($id);
       return response()->json([
            'id' => $cuenta->id,
            'saldo' => $cuenta->saldo,
            'titularCuenta' => $cuenta->titularCuenta,
            'tipoCuenta' => $cuenta->tipoCuenta->nombre, 
            'historialTransacciones' => $cuenta->transacciones->map(function ($transaccion) {
                return [
                    'tipo' => $transaccion->tipoTransaccion->nombre, 
                    'monto' => $transaccion->monto,
                    'fecha' => $transaccion->created_at->format('Y-m-d H:i:s')
                ];
            }),
        ]);
   }

   public function depositar(Request $request, $id)
   {
       $request->validate(['monto' => 'required|numeric|min:0']);

       $cuenta = CuentaFinanciera::findOrFail($id);
       $cuenta->saldo += $request->monto;
    
       $cuenta->transacciones()->create([
           'tipo_transaccion_id' => 1, 
           'cuenta_id' => $cuenta->id,
           'monto' => $request->monto,
           'fecha' => now(),
           'created_at' => now(),
           'updated_at' => now(),
       ]);

       $cuenta->save();

       return response()->json($cuenta);
   }


   public function retirar(Request $request, $id)
   {
    $request->validate(['monto' => 'required|numeric|min:0']);


    $cuenta = CuentaFinanciera::findOrFail($id);


    $comision = ($cuenta->tipoCuenta->id === 1) ? ($request->monto * 0.02) : 0;
    $totalRetiro = $request->monto + $comision;

    if ($cuenta->saldo < $totalRetiro) {
        return response()->json(['error' => 'Fondos insuficientes'], 400);
    }

    if ( $cuenta->tipoCuenta->id == 1 && ($cuenta->saldo - $totalRetiro) < 100) {
        return response()->json(['error' => 'Saldo mínimo no permitido'], 400);
    }

    $cuenta->saldo -= $totalRetiro;
    
    
    $transaccion = $cuenta->transacciones()->create([
        'tipo_transaccion_id' => 2, 
        'monto' => $totalRetiro,
        'fecha' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    

    $cuenta->save();

     return response()->json([
            'id' => $cuenta->id,
            'saldo' => $cuenta->saldo,
            'titularCuenta' => $cuenta->titularCuenta,
            'tipoCuenta' => $cuenta->tipoCuenta->nombre, 
            'transaccionRealizada' => [
                'tipo' => $transaccion->tipoTransaccion->nombre, 
                'monto' => $transaccion->monto,
                'fecha' => $transaccion->created_at->format('Y-m-d H:i:s')
            ]
    ]);
   }
}
