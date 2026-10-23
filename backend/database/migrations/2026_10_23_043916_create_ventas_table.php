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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta');
            
            // Relación usuario_id -> usuarios(id_usuario)
            $table->foreignId('usuario_id')
                  ->constrained('usuarios', 'id_usuario')
                  ->cascadeOnDelete();

            // Relación producto_id -> productos(id_producto)
            $table->foreignId('producto_id')
                  ->constrained('productos', 'id_producto')
                  ->cascadeOnDelete();

            $table->decimal('monto_venta', 10, 2);
            $table->integer('cantidad_venta')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};