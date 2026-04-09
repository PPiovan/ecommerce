<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventario_movimientos', function (Blueprint $table) {
            $table->integer('stock_anterior')->after('cantidad')->default(0);
            $table->integer('stock_nuevo')->after('stock_anterior')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('inventario_movimientos', function (Blueprint $table) {
            $table->dropColumn(['stock_anterior', 'stock_nuevo']);
        });
    }
};