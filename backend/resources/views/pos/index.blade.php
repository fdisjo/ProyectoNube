<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto de Venta | Abarrotes</title>
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
        }
        .main-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            background: #ffffff;
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            padding: 0.6rem 0.9rem;
            background-color: #f8fafc;
        }
        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .upload-box {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .upload-box:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }
        .img-preview-box {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }
        .table-custom th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }
        .table-custom td {
            vertical-align: middle;
            font-size: 0.95rem;
        }
        .btn-sell {
            background-color: #0ea5e9;
            color: white;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            padding: 0.4rem 1rem;
            transition: all 0.2s;
        }
        .btn-sell:hover {
            background-color: #0284c7;
            color: white;
        }
        .badge-brand {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }
    </style>
</head>
<body class="p-3 p-md-4">

<div class="container-fluid max-width-xl">
    <!-- Navbar Superior -->
    <header class="main-card p-3 px-4 mb-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                <i class="fa-solid fa-basket-shopping fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0 text-dark">Punto de Venta</h5>
                <small class="text-muted">Abarrotes generales</small>
            </div>
        </div>
        
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 px-3 fw-medium">
                <i class="fa-solid fa-right-from-bracket me-1"></i> Salir
            </button>
        </form>
    </header>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center gap-2 mb-4">
            <i class="fa-solid fa-circle-check fs-5"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="row g-4">
        <!-- Columna Izquierda: Formulario -->
        <div class="col-lg-5 col-xl-4">
            <div class="main-card p-4 h-100">
                <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">
                    <i class="fa-solid fa-plus-circle text-primary me-2"></i>Registrar Producto
                </h6>

                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Carga de Imagen -->
                    <div class="mb-3 text-center">
                        <label for="imagen_producto" class="upload-box p-3 w-100 d-block">
                            <div id="uploadPlaceholder">
                                <i class="fa-regular fa-image fs-2 text-muted mb-2"></i>
                                <span class="d-block text-secondary small fw-medium">Subir imagen del producto</span>
                                <span class="text-muted extra-small" style="font-size: 0.75rem;">JPG, PNG hasta 2MB</span>
                            </div>
                            <img id="imgPreview" class="img-preview-box d-none mx-auto" alt="Vista previa">
                        </label>
                        <input type="file" name="imagen_producto" id="imagen_producto" class="d-none" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">Nombre del Producto</label>
                        <input type="text" name="nombre_producto" class="form-control" placeholder="Ej. Sabritas Sal 45g" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">Descripción</label>
                        <input type="text" name="descripcion_producto" class="form-control" placeholder="Ej. Papas fritas con sal">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">Marca</label>
                        <select name="marca_producto" class="form-select" required>
                            <option value="" selected disabled>- Seleccionar marca -</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id_marca }}">{{ $marca->nombre_marca }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-medium">Precio de Venta</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-white text-muted">$</span>
                            <input type="number" step="0.01" name="precio_producto" class="form-control border-start-0" placeholder="0.00" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Producto
                    </button>
                </form>
            </div>
        </div>

        <!-- Columna Derecha: Tabla de Productos -->
        <div class="col-lg-7 col-xl-8">
            <div class="main-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <h6 class="fw-bold text-dark mb-0">
                        <i class="fa-solid fa-boxes-stacked text-primary me-2"></i>Catálogo de Productos
                    </h6>
                    <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill">
                        {{ count($productos) }} Registrados
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-custom align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Acción</th>
                                <th>Imagen</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $producto)
                                <tr>
                                    <td class="text-center">
                                        <button class="btn btn-sell shadow-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmarVentaModal"
                                                onclick="prepararModal('{{ $producto->id_producto }}', '{{ $producto->nombre_producto }}', '{{ $producto->precio_producto }}')">
                                            <i class="fa-solid fa-cart-shopping me-1"></i> Vender
                                        </button>
                                    </td>
                                    <td>
                                        @if($producto->imagen_producto)
                                            <img src="{{ asset('storage/' . $producto->imagen_producto) }}" class="rounded-3 object-fit-cover" width="45" height="45" alt="Producto">
                                        @else
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted" style="width: 45px; height: 45px;">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $producto->nombre_producto }}</div>
                                        <small class="text-muted">{{ $producto->descripcion_producto ?? 'Sin descripción' }}</small>
                                    </td>
                                    <td>
                                        <span class="badge-brand">{{ $producto->marca->nombre_marca }}</span>
                                    </td>
                                    <td class="fw-bold text-dark">
                                        ${{ number_format($producto->precio_producto, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-box-open fs-1 mb-2 d-block text-secondary"></i>
                                        No hay productos registrados aún.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ModalView Estilizado de Confirmación -->
<div class="modal fade" id="confirmarVentaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ventas.store') }}" method="POST">
                @csrf
                <div class="modal-body text-center pt-0 px-4">
                    <div class="bg-info-subtle text-info rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-receipt fs-3"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Confirmar Venta</h5>
                    <p class="text-muted small mb-3">¿Deseas procesar la transacción de este producto?</p>
                    
                    <div class="bg-light p-3 rounded-3 mb-3">
                        <div id="modalNombreProducto" class="fw-semibold text-dark"></div>
                        <div id="modalPrecioProducto" class="fs-4 fw-bold text-success mt-1"></div>
                    </div>
                    
                    <input type="hidden" name="producto_id" id="modalProductoId">
                </div>
                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-3 w-100 fw-medium mb-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success rounded-3 w-100 fw-semibold py-2">Procesar Venta</button>
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

    function previewImage(event) {
        const reader = new FileReader();
        const placeholder = document.getElementById('uploadPlaceholder');
        const preview = document.getElementById('imgPreview');
        
        reader.onload = function() {
            preview.src = reader.result;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
        }
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
</body>
</html>