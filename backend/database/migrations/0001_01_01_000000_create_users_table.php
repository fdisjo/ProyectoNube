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
        // 1. Tabla de Usuarios adaptada a tu Diagrama ER
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario'); // PK
            $table->string('nombre_usuario');
            $table->string('nick_usuario')->unique();
            $table->string('correo_usuario')->unique();
            $table->string('contrasena_usuario');
            $table->rememberToken(); // Requerido por la autenticación de Laravel
            $table->timestamps();
        });

        // 2. Tabla de restablecimiento de contraseña
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('correo_usuario')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. Tabla de sesiones de Laravel
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios', 'id_usuario')->cascadeOnDelete();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('usuarios');
    }
};