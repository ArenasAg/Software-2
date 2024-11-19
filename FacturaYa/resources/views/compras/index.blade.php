<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FacturaYa</title>

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
        <p>Biblioteca</p>
    </div>

    <div class="user-profile text-center mb-4">
        <img src="https://via.placeholder.com/80" alt="Perfil de usuario" class="rounded-circle mb-3" width="80" height="80">
        <h6>Bienvenido, Usuario</h6>
    </div>

    <ul class="menu-modern">
        <li>
            <div class="search-container d-flex align-items-center">
                <input type="text" class="search-modern form-control" id="libroSearch" placeholder="Buscar libros...">
            </div>
        </li>
        <li>
            <a href="#" data-bs-toggle="collapse" data-bs-target="#filterSubmenu" aria-expanded="false" aria-controls="filterSubmenu">
                <i class="fas fa-filter"></i>
                Filtros
            </a>
            <ul class="collapse submenu" id="filterSubmenu">
                <li>
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#filterSubmenuOrdenar" aria-expanded="false" aria-controls="filterSubmenu">
                        <i class="fas fa-filter"></i>
                        Ordenar por
                    </a>
                    <ul class="collapse submenu" id="filterSubmenuOrdenar">
                        <li>
                            <a href="libros/filter" class="sort-filter" data-sort="name_asc">Nombre (A-Z)</a>
                        </li>
                        <li>
                            <a href="libros/filter" class="sort-filter" data-sort="name_desc">Nombre (Z-A)</a>
                        </li>
                        <li>
                            <a href="libros/filter" class="sort-filter" data-sort="recent">Más recientes</a>
                        </li>
                        <li>
                            <a href="libros/filter" class="sort-filter" data-sort="oldest">Más antiguos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#filterSubmenuCategorias" aria-expanded="false" aria-controls="filterSubmenu">
                        <i class="fas fa-filter"></i>
                        Categorias
                    </a>
                    <ul class="collapse submenu" id="filterSubmenuCategorias">
                        @foreach($categorias as $categoria)
                            <li>
                                <a href="#" class="category-filter" data-category="{{ $categoria->id }}">{{ $categoria->nombre }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<div class="content-area">
    <div class="row" id="productList">
        @foreach($libros->chunk(4) as $chunk)
            <div class="row mb-4">
                @foreach($chunk as $libro)
                    <div class="col-md-3 d-flex align-items-stretch">
                        <div class="card w-100">
                            <img src="{{ asset('storage/' . $libro->imagen) }}" class="card-img-top" alt="{{ $libro->nombre }}" style="height: 500px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $libro->nombre }}</h5>
                                <p class="card-text"><strong>Precio:</strong> ${{ $libro->precio }}</p>
                                <a href="{{ route('libros.show', $libro->id) }}" class="btn btnAdd mt-auto">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $libros->links() }}
    </div>
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
