<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.ddd
     */
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            if (!Schema::hasColumn('clientes', 'deleted_at')) {
                $table->softDeletes(); // Agrega la columna deleted_at
            }
        });

        Schema::table('compras', function (Blueprint $table) {
            if (!Schema::hasColumn('compras', 'deleted_at')) {
                $table->softDeletes(); // Agrega la columna deleted_at
            }
        });

        Schema::table('productos', function (Blueprint $table) {
            if (!Schema::hasColumn('productos', 'deleted_at')) {
                $table->softDeletes(); // Agrega la columna deleted_at
            }
        });

        Schema::table('proveedors', function (Blueprint $table) {
            if (!Schema::hasColumn('proveedors', 'deleted_at')) {
                $table->softDeletes(); // Agrega la columna deleted_at
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            if (Schema::hasColumn('clientes', 'deleted_at')) {
                $table->dropSoftDeletes(); // Elimina la columna deleted_at
            }
        });

        Schema::table('compras', function (Blueprint $table) {
            if (Schema::hasColumn('compras', 'deleted_at')) {
                $table->dropSoftDeletes(); // Elimina la columna deleted_at
            }
        });

        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'deleted_at')) {
                $table->dropSoftDeletes(); // Elimina la columna deleted_at
            }
        });

        Schema::table('proveedors', function (Blueprint $table) {
            if (Schema::hasColumn('proveedors', 'deleted_at')) {
                $table->dropSoftDeletes(); // Elimina la columna deleted_at
            }
        });

        Schema::table('sales', function (Blueprint $table) {
            if (Schema::hasColumn('sales', 'deleted_at')) {
                $table->dropSoftDeletes(); // Elimina la columna deleted_at
            }
        });
    }
};
