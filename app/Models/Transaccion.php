<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    //use HasFactory;

    protected $table = 'transacciones';
    
    protected $fillable = [
        'cuenta_id',          // Clave foránea a cuentas_financieras
        'tipo_transaccion_id',// Clave foránea a tipos_transaccion
        'monto',              // Monto de la transacción
        'created_at',         // Fecha de creación
        'updated_at',         // Fecha de actualización
    ];

    public function cuenta()
    {
        return $this->belongsTo(CuentaFinanciera::class);
    }

    public function tipoTransaccion()
    {
        return $this->belongsTo(TipoTransaccion::class);
    }

}
