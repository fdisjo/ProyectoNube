<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas | POS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; }
        .main-card { border: none; border-radius: 16px; background: #ffffff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="p-3 p-md-4">

<div class="container-fluid max-width-xl">
    <header class="main-card p-3 px-4 mb-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('pos.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver
            </a>
            <h5 class="fw-bold mb-0 text-dark">Historial de Ventas</h5>
        </div>
    </header>

    <div class="main-card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Folio</th>
                        <th>Atendido por</th>
                        <th>Productos Comprados</th>
                        <th>Total</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas as $venta)
                        <tr>
                            <td class="fw-bold text-primary">#{{ str_pad($venta->id_venta, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $venta->usuario->nombre_usuario ?? 'Sistema' }}</td>
                            <td>
                                <ul class="list-unstyled mb-0 small">
                                    @foreach($venta->detalles as $detalle)
                                        <li>
                                            <span class="badge bg-secondary me-1">{{ $detalle->cantidad }}x</span>
                                            {{ $detalle->producto->nombre_producto ?? 'Producto borrado' }}
                                            <span class="text-muted">(${{ number_format($detalle->subtotal, 2) }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="fw-bold text-success">${{ number_format($venta->monto_venta, 2) }}</td>
                            <td class="text-muted small">{{ $venta->created_at->format('d/m/Y h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No hay registros de ventas realizadas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $ventas->links() }}
        </div>
    </div>
</div>

</body>
</html>