<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->foreignId('cuenta_id')->constrained('cuentas_financieras', 'id')->onDelete('cascade'); // Clave foránea a cuentas_financieras
            $table->foreignId('tipo_transaccion_id')->constrained('tipos_transaccion', 'id')->onDelete('cascade'); // Clave foránea a tipos_transaccion
            $table->decimal('monto', 15, 2); // Monto de la transacción
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
