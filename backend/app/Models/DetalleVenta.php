<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }
}