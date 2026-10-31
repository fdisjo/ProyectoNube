<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto de Venta - [ abarrotes ]</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container-fluid bg-white p-4 rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h3 class="m-0">Punto de venta - [ abarrotes ]</h3>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Cerrar Sesión</button>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- Formulario de Registro de Producto (Izquierda) -->
        <div class="col-md-5 border-end pe-4">
            <h5 class="text-secondary mb-3">- DATOS DEL PRODUCTO -</h5>

            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 text-center">
                    <label for="imagen_producto" class="form-label d-block">
                        <div class="border rounded p-3 bg-light text-muted cursor-pointer">
                            <span class="d-block mb-1">🖼️ Cargar Imagen</span>
                            <small class="text-secondary">(Haz clic para seleccionar)</small>
                        </div>
                    </label>
                    <input type="file" name="imagen_producto" id="imagen_producto" class="d-none">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre_producto" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <input type="text" name="descripcion_producto" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Marca</label>
                    <select name="marca_producto" class="form-select" required>
                        <option value="">- Seleccionar -</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id_marca }}">{{ $marca->nombre_marca }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" name="precio_producto" class="form-control" placeholder="0.00" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold">- REGISTRAR PRODUCTO -</button>
            </form>
        </div>

        <!-- Tabla de Productos Registrados (Derecha) -->
        <div class="col-md-7 ps-4">
            <h5 class="text-secondary mb-3 text-center">PRODUCTOS REGISTRADOS</h5>

            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>VENDER</th>
                        <th>PRODUCTO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>MARCA</th>
                        <th>PRECIO</th>
                        <th>IMAGEN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>
                                <!-- Botón para abrir el Modal (ModalView) -->
                                <button class="btn btn-info btn-sm text-white px-3" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmarVentaModal"
                                        onclick="prepararModal('{{ $producto->id_producto }}', '{{ $producto->nombre_producto }}', '{{ $producto->precio_producto }}')">
                                    Vender
                                </button>
                            </td>
                            <td>{{ $producto->nombre_producto }}</td>
                            <td>{{ $producto->descripcion_producto ?? 'N/A' }}</td>
                            <td>{{ $producto->marca->nombre_marca }}</td>
                            <td>${{ number_format($producto->precio_producto, 2) }}</td>
                            <td>
                                @if($producto->imagen_producto)
                                    <img src="{{ asset('storage/' . $producto->imagen_producto) }}" width="40" height="40" class="rounded" alt="Producto">
                                @else
                                    <span class="text-muted">🖼️</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODALVIEW DE CONFIRMACIÓN DE VENTA -->
<div class="modal fade" id="confirmarVentaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ventas.store') }}" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <p>¿Estás seguro de concretar la venta del siguiente producto?</p>
                    <h4 id="modalNombreProducto" class="text-primary"></h4>
                    <h5 id="modalPrecioProducto" class="text-success"></h5>
                    <input type="hidden" name="producto_id" id="modalProductoId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Confirmar Venta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function prepararModal(id, nombre, precio) {
        document.getElementById('modalProductoId').value = id;
        document.getElementById('modalNombreProducto').innerText = nombre;
        document.getElementById('modalPrecioProducto').innerText = '$' + parseFloat(precio).toFixed(2);
    }
</script>
</body>
</html>