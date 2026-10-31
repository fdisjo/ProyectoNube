<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | POS Abarrotes</title>
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            background: #ffffff;
        }
        .avatar-box {
            width: 80px;
            height: 80px;
            background: #eff6ff;
            color: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto;
        }
        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .btn-primary-custom {
            background-color: #2563eb;
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-primary-custom:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center p-3">

<div class="card login-card p-4 p-md-5" style="width: 100%; max-width: 400px;">
    <div class="text-center mb-4">
        <div class="avatar-box mb-3">
            <i class="fa-solid fa-store"></i>
        </div>
        <h4 class="fw-bold text-dark mb-1">Bienvenido</h4>
        <p class="text-muted small">Ingresa tus credenciales para acceder</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 rounded-3 small py-2 mb-3">
            <i class="fa-solid fa-circle-exclamation me-1"></i> {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nick_usuario" class="form-label text-secondary small fw-medium">Usuario</label>
            <div class="input-group">
                <input type="text" name="nick_usuario" id="nick_usuario" class="form-control" required placeholder="admin">
            </div>
        </div>

        <div class="mb-4">
            <label for="contrasena_usuario" class="form-label text-secondary small fw-medium">Contraseña</label>
            <input type="password" name="contrasena_usuario" id="contrasena_usuario" class="form-control" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn btn-primary btn-primary-custom text-white w-100">
            Iniciar Sesión <i class="fa-solid fa-arrow-right ms-2"></i>
        </button>
    </form>
</div>

</body>
</html>