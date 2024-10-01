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
        Schema::table('transacciones', function (Blueprint $table) {
            $table->foreignId('cuenta_id')->constrained('cuentas_financieras', 'id')->onDelete('cascade');
            $table->foreignId('tipo_transaccion_id')->constrained('tipos_transaccion', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transacciones', function (Blueprint $table) {
            $table->dropForeign(['cuenta_id']);
            $table->dropForeign(['tipo_transaccion_id']);
            $table->dropColumn(['cuenta_id', 'tipo_transaccion_id']); 
        });
    }
};
