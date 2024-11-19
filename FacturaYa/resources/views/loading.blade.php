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
<body class="theme-modern bodyAuth">
    <div class="book">
        <div class="book-inner">
            <!-- Portada más gruesa -->
            <div class="book-cover front">
            <h1 class="cover-title">BIBLIOTECA</h1>
        </div>
            
            <!-- Varias páginas con la misma clase -->
            <div class="book-page"></div>
            <div class="book-page"></div>
            <div class="book-page"></div>
            <div class="book-page"></div>
            <div class="book-page"></div>
            <div class="book-page"></div>
            <div class="book-page"></div>
            <div class="book-page"></div>
            <div class="book-page"></div>
            <div class="book-page"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                window.location.href = "{{ route('login') }}";
            }, 5000); // 2 segundos para la animación
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
