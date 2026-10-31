<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id('id_detalle');
            
            $table->foreignId('venta_id')
                  ->constrained('ventas', 'id_venta')
                  ->cascadeOnDelete();

            $table->foreignId('producto_id')
                  ->constrained('productos', 'id_producto')
                  ->cascadeOnDelete();

            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};