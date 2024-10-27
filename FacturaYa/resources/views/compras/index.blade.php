@extends('layouts.layout')

@section('title', 'Compras')

@section('content')
<div class="container">
    <h1>Compras</h1>

    <!-- Filtros -->
    <div class="filters mb-4">
        <form method="GET" action="{{ route('compras.index') }}" class="form-inline justify-content-center">
            <div class="form-group mx-2 mb-2">
                <label for="category" class="sr-only">Categoría:</label>
                <select name="category" id="category" class="form-control form-control-sm">
                    <option value="">Todas</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mx-2 mb-2">
                <label for="price" class="sr-only">Precio:</label>
                <input type="range" name="price" id="price" min="0" max="1000" step="10" class="form-control form-control-sm">
            </div>
            <div class="form-group mx-2 mb-2">
                <label for="sort" class="sr-only">Ordenar por:</label>
                <select name="sort" id="sort" class="form-control form-control-sm">
                    <option value="name_asc">Nombre (A-Z)</option>
                    <option value="name_desc">Nombre (Z-A)</option>
                    <option value="price_asc">Precio (Menor a Mayor)</option>
                    <option value="price_desc">Precio (Mayor a Menor)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm mb-2">Aplicar Filtros</button>
        </form>
    </div>

    <!-- Lista de productos -->
    <div class="products row">
        @foreach($productos as $producto)
            <div class="producto col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="card-img-top rounded-top img-fluid" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="card-text">Precio: ${{ $producto->precio }}</p>
                        <a  class="btn btn-success btn-sm">Agregar al Carrito</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="pagination justify-content-center">
        {{ $productos->links() }}
    </div>
</div>
@endsection
