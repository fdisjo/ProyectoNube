<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto'); // PK[cite: 2]
            $table->string('nombre_producto');[cite: 2]
            $table->text('descripcion_producto')->nullable();[cite: 2]
            $table->decimal('precio_producto', 10, 2);[cite: 2]
            $table->string('imagen_producto')->nullable();[cite: 2]
            
            // Llave foránea hacia Marcas (marca_producto)[cite: 2]
            $table->unsignedBigInteger('marca_producto');[cite: 2]
            $table->foreign('marca_producto')
                  ->references('id_marca')
                  ->on('marcas')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};