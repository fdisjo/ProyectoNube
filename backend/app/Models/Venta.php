<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $fillable = [
        'usuario_id',
        'producto_id',
        'monto_venta',
        'cantidad_venta',
    ];

    // Relación: Una venta pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }

    // Relación: Una venta pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id_usuario');
    }
}