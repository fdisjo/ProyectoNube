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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre_producto');
            $table->text('descripcion_producto')->nullable();
            $table->decimal('precio_producto', 10, 2);
            $table->string('imagen_producto')->nullable();
            
            // Relación marca_producto -> marcas(id_marca)
            $table->foreignId('marca_producto')
                  ->constrained('marcas', 'id_marca')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};