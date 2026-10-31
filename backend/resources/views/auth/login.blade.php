<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Punto de Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow p-4" style="width: 350px;">
    <h4 class="text-center mb-4">INICIAR SESIÓN</h4>
    
    <div class="text-center mb-3">
        <img src="https://via.placeholder.com/100" class="rounded-circle" alt="Usuario">
    </div>

    @if ($errors->any())
        <div class="alert alert-danger p-2 small">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nick_usuario" class="form-label">Usuario</label>
            <input type="text" name="nick_usuario" id="nick_usuario" class="form-control" required placeholder="admin">
        </div>

        <div class="mb-3">
            <label for="contrasena_usuario" class="form-label">Contraseña</label>
            <input type="password" name="contrasena_usuario" id="contrasena_usuario" class="form-control" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn btn-primary w-100">INICIAR SESIÓN</button>
    </form>
</div>

</body>
</html>