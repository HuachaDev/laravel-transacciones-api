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
        Schema::create('cuentas_financieras', function (Blueprint $table) {
            $table->id();
            $table->decimal('saldo', 15, 2);
            $table->string('titularCuenta');
            $table->string('direccion');
            $table->foreignId('tipo_cuenta_id')->constrained('tipos_cuenta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_financieras');
    }
};
