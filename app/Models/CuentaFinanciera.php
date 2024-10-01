<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaFinanciera extends Model
{
    //use HasFactory;

    protected $table = 'cuentas_financieras';

    public function tipoCuenta()
    {
        return $this->belongsTo(TipoCuenta::class);
    }

    
    public function transacciones()
    {
 
       return $this->hasMany(Transaccion::class, 'cuenta_id');
    }
    
 

}
