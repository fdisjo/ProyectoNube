<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'nombre_producto', 
        'descripcion_producto', 
        'precio_producto', 
        'imagen_producto', 
        'marca_producto'
    ];

    // Relación con Marca
    public function marca()
    {
        return $table->belongsTo(Marca::class, 'marca_producto', 'id_marca');
    }
}