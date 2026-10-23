<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Support\Facades\Hash;

class DatosInicialesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear usuario de prueba para poder iniciar sesión
        $usuario = User::create([
            'nombre_usuario' => 'Usuario Administrador',
            'nick_usuario' => 'admin',
            'correo_usuario' => 'admin@ejemplo.com',
            'contrasena_usuario' => Hash::make('12345678'),
        ]);

        // 2. Crear las marcas base
        $cocaCola = Marca::create(['nombre_marca' => 'Coca-Cola']);
        $sabritas = Marca::create(['nombre_marca' => 'Sabritas']);
        $gamesa = Marca::create(['nombre_marca' => 'Gamesa']);
        $jarritos = Marca::create(['nombre_marca' => 'Jarritos']);

        // 3. Crear productos de prueba mostrados en el diseño del PDF
        Producto::create([
            'nombre_producto' => 'Coca-Cola',
            'descripcion_producto' => 'cero',
            'precio_producto' => 18.00,
            'marca_producto' => $cocaCola->id_marca,
        ]);

        Producto::create([
            'nombre_producto' => 'Sabritas',
            'descripcion_producto' => 'Limon',
            'precio_producto' => 15.00,
            'marca_producto' => $sabritas->id_marca,
        ]);

        Producto::create([
            'nombre_producto' => 'Galletas Marias',
            'descripcion_producto' => 'Simples',
            'precio_producto' => 17.00,
            'marca_producto' => $gamesa->id_marca,
        ]);

        Producto::create([
            'nombre_producto' => 'Refresco Jarritos',
            'descripcion_producto' => 'De limon',
            'precio_producto' => 20.00,
            'marca_producto' => $jarritos->id_marca,
        ]);
    }
}