<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id_producto',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        Venta::create([
            'usuario_id' => Auth::id(),
            'producto_id' => $producto->id_producto,
            'monto_venta' => $producto->precio_producto,
            'cantidad_venta' => 1,
        ]);

        return redirect()->route('pos.index')->with('success', 'Venta realizada con éxito');
    }
}