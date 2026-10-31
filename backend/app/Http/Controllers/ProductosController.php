<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Marca;

class ProductosController extends Controller
{
    public function index()
    {
        // Obtener productos con su marca asociada
        $productos = Producto::with('marca')->get();
        $marcas = Marca::all();

        return view('pos.index', compact('productos', 'marcas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:150',
            'descripcion_producto' => 'nullable|string',
            'marca_producto' => 'required|exists:marcas,id_marca',
            'precio_producto' => 'required|numeric|min:0',
            'imagen_producto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('imagen_producto')) {
            $path = $request->file('imagen_producto')->store('productos', 'public');
        }

        Producto::create([
            'nombre_producto' => $request->nombre_producto,
            'descripcion_producto' => $request->descripcion_producto,
            'marca_producto' => $request->marca_producto,
            'precio_producto' => $request->precio_producto,
            'imagen_producto' => $path,
        ]);

        return redirect()->route('pos.index')->with('success', 'Producto registrado correctamente');
    }
}