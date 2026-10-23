<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $fillable = [
        'usuario_id', 
        'producto_id', 
        'monto_venta', 
        'cantidad_venta'
    ];
}