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
        Schema::table('cuentas_financieras', function (Blueprint $table) {
            $table->foreignId('tipo_cuenta_id')->constrained('tipos_cuenta', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuentas_financieras', function (Blueprint $table) {
            $table->dropForeign(['tipo_cuenta_id']);
            $table->dropColumn('tipo_cuenta_id');
        });
    }
};
