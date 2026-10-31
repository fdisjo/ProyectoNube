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
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; color: #334155; }
        .main-card { border: none; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); background: #ffffff; }
        .form-control, .form-select { border-radius: 10px; border: 1px solid #cbd5e1; padding: 0.6rem 0.9rem; background-color: #f8fafc; }
        .form-control:focus, .form-select:focus { background-color: #ffffff; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); }
        .upload-box { border: 2px dashed #cbd5e1; border-radius: 12px; background: #f8fafc; cursor: pointer; transition: all 0.2s; }
        .upload-box:hover { border-color: #3b82f6; background: #eff6ff; }
        .img-preview-box { width: 90px; height: 90px; object-fit: cover; border-radius: 10px; }
        .table-custom th { background-color: #f8fafc; color: #64748b; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .btn-add-cart { background-color: #0ea5e9; color: white; border-radius: 8px; font-weight: 500; border: none; padding: 0.35rem 0.8rem; }
        .btn-add-cart:hover { background-color: #0284c7; color: white; }
        .cart-item { border-bottom: 1px solid #f1f5f9; padding: 0.75rem 0; }
        .cart-item:last-child { border-bottom: none; }
    </style>
</head>
<body class="p-3 p-md-4">

<div class="container-fluid">
    <!-- Header -->
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

        <div class="d-flex gap-2 align-items-center">
            <!-- Botón de Historial de Ventas -->
            <a href="{{ route('ventas.historial') }}" class="btn btn-outline-primary btn-sm rounded-3 px-3 fw-medium">
                <i class="fa-solid fa-clock-rotate-left me-1"></i> Historial de Ventas
            </a>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 px-3 fw-medium">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Salir
                </button>
            </form>
        </div>
    </header>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <!-- Columna 1: Formulario para Agregar Producto (Izquierda) -->
        <div class="col-lg-3">
            <div class="main-card p-4 h-100">
                <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">
                    <i class="fa-solid fa-plus-circle text-primary me-2"></i>Nuevo Producto
                </h6>

                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 text-center">
                        <label for="imagen_producto" class="upload-box p-3 w-100 d-block">
                            <div id="uploadPlaceholder">
                                <i class="fa-regular fa-image fs-3 text-muted mb-1"></i>
                                <span class="d-block text-secondary small">Subir imagen</span>
                            </div>
                            <img id="imgPreview" class="img-preview-box d-none mx-auto" alt="Preview">
                        </label>
                        <input type="file" name="imagen_producto" id="imagen_producto" class="d-none" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <div class="mb-2">
                        <label class="form-label extra-small fw-medium">Nombre</label>
                        <input type="text" name="nombre_producto" class="form-control form-control-sm" required placeholder="Ej. Coca Cola 600ml">
                    </div>

                    <div class="mb-2">
                        <label class="form-label extra-small fw-medium">Descripción</label>
                        <input type="text" name="descripcion_producto" class="form-control form-control-sm" placeholder="Ej. Retornable">
                    </div>

                    <div class="mb-2">
                        <label class="form-label extra-small fw-medium">Marca</label>
                        <select name="marca_producto" class="form-select form-select-sm" required>
                            <option value="" selected disabled>- Seleccionar -</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id_marca }}">{{ $marca->nombre_marca }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label extra-small fw-medium">Precio</label>
                        <input type="number" step="0.01" name="precio_producto" class="form-control form-control-sm" placeholder="0.00" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 btn-sm fw-semibold">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Registrar Producto
                    </button>
                </form>
            </div>
        </div>

        <!-- Columna 2: Catálogo de Productos (Centro) -->
        <div class="col-lg-5">
            <div class="main-card p-4 h-100">
                <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">
                    <i class="fa-solid fa-boxes-stacked text-primary me-2"></i>Catálogo de Productos
                </h6>

                <div class="table-responsive">
                    <table class="table table-hover table-custom align-middle">
                        <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $producto)
                                <tr>
                                    <td>
                                        <button class="btn btn-add-cart btn-sm" 
                                                onclick="agregarAlCarrito({{ $producto->id_producto }}, '{{ $producto->nombre_producto }}', {{ $producto->precio_producto }})">
                                            <i class="fa-solid fa-plus me-1"></i> Agregar
                                        </button>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $producto->nombre_producto }}</div>
                                        <small class="text-muted">{{ $producto->descripcion_producto ?? '' }}</small>
                                    </td>
                                    <td><span class="badge bg-light text-dark">{{ $producto->marca->nombre_marca }}</span></td>
                                    <td class="fw-bold">${{ number_format($producto->precio_producto, 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-4 text-muted">No hay productos disponibles.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Columna 3: Carrito de Compras Dinámico (Derecha) -->
        <div class="col-lg-4">
            <div class="main-card p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <h6 class="fw-bold text-dark mb-3 border-bottom pb-2 d-flex justify-content-between align-items-center">
                        <span><i class="fa-solid fa-cart-shopping text-primary me-2"></i>Orden Actual</span>
                        <span id="cantProductosCarrito" class="badge bg-primary rounded-pill">0 items</span>
                    </h6>

                    <div id="listaCarrito" class="overflow-auto" style="max-height: 350px;">
                        <div class="text-center py-5 text-muted" id="carritoVacio">
                            <i class="fa-solid fa-basket-shopping fs-1 text-secondary mb-2 d-block"></i>
                            El carrito está vacío.<br>Haz clic en "Agregar" en los productos.
                        </div>
                    </div>
                </div>

                <div class="border-top pt-3 mt-3">
                    <div class="d-flex justify-content-between fs-5 fw-bold mb-3">
                        <span>Total:</span>
                        <span class="text-success" id="totalCarritoText">$0.00</span>
                    </div>

                    <button id="btnProcesarVenta" class="btn btn-success w-100 py-2 rounded-3 fw-bold disabled" data-bs-toggle="modal" data-bs-target="#confirmarVentaModal">
                        <i class="fa-solid fa-cash-register me-1"></i> Confirmar y Vender
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ModalView de Confirmación Multiproducto -->
<div class="modal fade" id="confirmarVentaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold modal-title">Resumen de Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center px-4">
                <p class="text-muted small mb-3">Verifica los elementos agregados antes de finalizar:</p>
                <div id="modalResumenProductos" class="text-start bg-light p-3 rounded-3 mb-3 small" style="max-height: 200px; overflow-y: auto;">
                    <!-- Se llena dinámicamente con JS -->
                </div>
                <div class="d-flex justify-content-between fs-4 fw-bold">
                    <span>Monto Total:</span>
                    <span id="modalTotalMonto" class="text-success"></span>
                </div>
            </div>
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-light rounded-3 fw-medium" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" onclick="enviarVentaBackend()" class="btn btn-success rounded-3 fw-semibold px-4">Realizar Venta</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let carrito = [];

    // 1. Agregar producto al carrito
    function agregarAlCarrito(id, nombre, precio) {
        let enCarrito = carrito.find(item => item.id === id);
        if(enCarrito) {
            enCarrito.cantidad++;
        } else {
            carrito.push({ id, nombre, precio: parseFloat(precio), cantidad: 1 });
        }
        renderizarCarrito();
    }

    // 2. Incrementar o decrementar cantidad
    function cambiarCantidad(id, cambio) {
        let item = carrito.find(i => i.id === id);
        if(item) {
            item.cantidad += cambio;
            if(item.cantidad <= 0) {
                eliminarDelCarrito(id);
                return;
            }
        }
        renderizarCarrito();
    }

    // 3. Eliminar producto individual
    function eliminarDelCarrito(id) {
        carrito = carrito.filter(item => item.id !== id);
        renderizarCarrito();
    }

    // 4. Dibujar carrito en pantalla
    function renderizarCarrito() {
        const contenedor = document.getElementById('listaCarrito');
        const vacio = document.getElementById('carritoVacio');
        const totalText = document.getElementById('totalCarritoText');
        const cantBadge = document.getElementById('cantProductosCarrito');
        const btnVender = document.getElementById('btnProcesarVenta');

        if(carrito.length === 0) {
            contenedor.innerHTML = '';
            if(vacio) contenedor.appendChild(vacio);
            if(vacio) vacio.classList.remove('d-none');
            totalText.innerText = '$0.00';
            cantBadge.innerText = '0 items';
            btnVender.classList.add('disabled');
            return;
        }

        if(vacio) vacio.classList.add('d-none');
        contenedor.innerHTML = '';
        let total = 0;
        let itemsContador = 0;

        carrito.forEach(item => {
            let subtotal = item.precio * item.cantidad;
            total += subtotal;
            itemsContador += item.cantidad;

            contenedor.innerHTML += `
                <div class="cart-item d-flex justify-content-between align-items-center py-2 border-bottom">
                    <div>
                        <div class="fw-semibold text-dark small">${item.nombre}</div>
                        <small class="text-muted">$${item.precio.toFixed(2)} c/u</small>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="cambiarCantidad(${item.id}, -1)">-</button>
                        <span class="fw-bold small">${item.cantidad}</span>
                        <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="cambiarCantidad(${item.id}, 1)">+</button>
                        <span class="fw-bold text-dark small ms-2">$${subtotal.toFixed(2)}</span>
                        <button type="button" class="btn btn-sm text-danger border-0 px-1" onclick="eliminarDelCarrito(${item.id})">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            `;
        });

        totalText.innerText = '$' + total.toFixed(2);
        cantBadge.innerText = itemsContador + ' items';
        btnVender.classList.remove('disabled');

        // Llenar Modal de Confirmación
        let resumenModal = document.getElementById('modalResumenProductos');
        if(resumenModal) {
            resumenModal.innerHTML = '';
            carrito.forEach(i => {
                resumenModal.innerHTML += `
                    <div class="d-flex justify-content-between mb-1">
                        <span>${i.cantidad}x ${i.nombre}</span>
                        <span class="fw-semibold">$${(i.precio * i.cantidad).toFixed(2)}</span>
                    </div>
                `;
            });
        }
        document.getElementById('modalTotalMonto').innerText = '$' + total.toFixed(2);
    }

    // 5. Enviar venta vía AJAX
    function enviarVentaBackend() {
        fetch('{{ route("ventas.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ productos: carrito })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert('¡Venta realizada con éxito!');
                carrito = [];
                renderizarCarrito();
                bootstrap.Modal.getInstance(document.getElementById('confirmarVentaModal')).hide();
            } else {
                alert('Error al registrar venta: ' + data.message);
            }
        })
        .catch(err => alert('Ocurrió un error en la transacción.'));
    }

    function previewImage(event) {
        const reader = new FileReader();
        const placeholder = document.getElementById('uploadPlaceholder');
        const preview = document.getElementById('imgPreview');
        reader.onload = function() {
            preview.src = reader.result;
            preview.classList.remove('d-none');
            if(placeholder) placeholder.classList.add('d-none');
        }
        if(event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>
</html>