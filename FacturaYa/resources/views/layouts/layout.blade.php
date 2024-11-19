<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BIBLIOTECA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="theme-modern">

<button id="sidebarCollapse">
    <i class="fas fa-bars"></i>
</button>

<nav class="sidebar-modern">
    <div class="text-center mb-4">
        <h3>FacturaYa</h3>
        <p>Sistema de Facturación</p>
    </div>

    <div class="user-profile text-center mb-4">
        <img src="https://via.placeholder.com/80" alt="Perfil de usuario" class="rounded-circle mb-3" width="80" height="80">
        <h6>Bienvenido, Usuario</h6>
    </div>

    <ul class="menu-modern">
        <li>
            <a href="{{ url('/dashboard') }}">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('categorias.index') }}">
                <i class="fas fa-tags"></i>
                Categorías
            </a>
        </li>
        <li>
            <a href="{{ route('clientes.index') }}">
                <i class="fas fa-users"></i>
                Clientes
            </a>
        </li>
        <li>
            <a href="{{ route('facturas.index') }}">
                <i class="fas fa-file-invoice"></i>
                Facturas
            </a>
        </li>
        <li>
            <a href="{{ route('impuestos.index') }}">
                <i class="fas fa-percent"></i>
                Impuestos
            </a>
        </li>
        <li>
            <a href="{{ route('informes.index') }}">
                <i class="fas fa-chart-bar"></i>
                Informes
            </a>
        </li>
        <li>
            <a href="{{ route('inventarios.index') }}">
                <i class="fas fa-box"></i>
                Inventarios
            </a>
        </li>
        <li>
            <a href="{{ route('metodoPagos.index') }}">
                <i class="fas fa-credit-card"></i>
                Métodos de Pago
            </a>
        </li>
        <li>
            <a href="{{ route('libros.index') }}">
                <i class="fas fa-shopping-cart"></i>
                Libros
            </a>
        </li>
    </ul>
</nav>


<div class="content-area">
    @yield('content')
</div>

<div class="notification-bell">
    <i class="fas fa-bell"></i>
    <span class="notification-dot"></span>
</div>

<button class="theme-toggle" id="themeToggle">
    <i class="fas fa-moon"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
