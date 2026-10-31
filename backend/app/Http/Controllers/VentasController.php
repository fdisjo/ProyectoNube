<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    // Mostrar Historial de Ventas
    public function historial()
    {
        $ventas = Venta::with(['usuario', 'detalles.producto'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('ventas.historial', compact('ventas'));
    }

    // Procesar Venta de Múltiples Productos (Carrito)
    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // 1. Crear la Venta (Cabecera)
            $venta = Venta::create([
                'usuario_id' => Auth::id(),
                'monto_venta' => 0, // Se actualizará al calcular el total
            ]);

            $totalVenta = 0;

            // 2. Insertar cada producto en el Detalle
            foreach ($request->productos as $item) {
                $producto = Producto::findOrFail($item['id']);
                $subtotal = $producto->precio_producto * $item['cantidad'];
                $totalVenta += $subtotal;

                DetalleVenta::create([
                    'venta_id' => $venta->id_venta,
                    'producto_id' => $producto->id_producto,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio_producto,
                    'subtotal' => $subtotal,
                ]);
            }

            // 3. Actualizar el total acumulado en la Venta
            $venta->update(['monto_venta' => $totalVenta]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Venta procesada con éxito',
                'venta_id' => $venta->id_venta
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la venta: ' . $e->getMessage()
            ], 500);
        }
    }
}