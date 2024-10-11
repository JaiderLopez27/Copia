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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->String('soporteCompra');
            $table->decimal('precioCompra');
            $table->decimal('valorUnidad');
            $table->foreignId('proveedors_id')->constrained('proveedors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('productos_id')->constrained('productos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
