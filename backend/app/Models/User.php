<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Indicamos el nombre exacto de la tabla y la llave primaria en español
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    /**
     * Atributos asignables en masa.
     */
    protected $fillable = [
        'nombre_usuario',
        'nick_usuario',
        'correo_usuario',
        'contrasena_usuario',
    ];

    /**
     * Atributos ocultos en serialización.
     */
    protected $hidden = [
        'contrasena_usuario',
        'remember_token',
    ];

    /**
     * Le indicamos a Laravel cuál es el campo para la contraseña
     */
    public function getAuthPassword()
    {
        return $this->contrasena_usuario;
    }

    /**
     * Le indicamos a Laravel cuál es el campo para el nombre de usuario/correo al autenticar
     */
    public function getEmailForPasswordReset()
    {
        return $this->correo_usuario;
    }
}