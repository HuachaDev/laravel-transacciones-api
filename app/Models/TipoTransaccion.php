<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTransaccion extends Model
{
    //use HasFactory;
    protected $table = 'tipos_transaccion';

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
