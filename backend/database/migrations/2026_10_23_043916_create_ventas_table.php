<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta');
            
            // Relación con el usuario que realiza la venta
            $table->foreignId('usuario_id')
                  ->constrained('usuarios', 'id_usuario')
                  ->cascadeOnDelete();

            $table->decimal('monto_venta', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};