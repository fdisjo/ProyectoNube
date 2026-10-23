<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta'); // PK[cite: 2]
            
            // FK hacia Usuarios[cite: 2]
            $table->unsignedBigInteger('usuario_id');[cite: 2]
            $table->foreign('usuario_id')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade');

            // FK hacia Productos[cite: 2]
            $table->unsignedBigInteger('producto_id');[cite: 2]
            $table->foreign('producto_id')
                  ->references('id_producto')
                  ->on('productos')
                  ->onDelete('cascade');

            $table->decimal('monto_venta', 10, 2);[cite: 2]
            $table->integer('cantidad_venta')->default(1);[cite: 2]
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};