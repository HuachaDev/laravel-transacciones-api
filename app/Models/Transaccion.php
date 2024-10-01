<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    //use HasFactory;

    protected $table = 'transacciones';
    
    protected $fillable = [
        'cuenta_id',          
        'tipo_transaccion_id',
        'monto',              
        'created_at',         
        'updated_at',         
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
