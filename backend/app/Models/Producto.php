<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'nombre_producto',
        'descripcion_producto',
        'precio_producto',
        'imagen_producto',
        'marca_producto',
    ];

    // Relación: Un producto pertenece a una marca
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_producto', 'id_marca');
    }

    // Relación: Un producto puede estar en muchas ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'producto_id', 'id_producto');
    }
}