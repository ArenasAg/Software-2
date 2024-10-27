@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Lista de Productos</h1>

    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Producto</a>

    @if($productos->isEmpty())
        <p>No hay productos disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio de Venta</th>
                    <th>Medida</th>
                    <th>Categoría</th>
                    <th>Impuesto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->codigo }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="50" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(10)';" onmouseout="this.style.transform='scale(1)';">
                    </td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->medida }}</td>
                    <td>{{ $producto->categoria_id }}</td>
                    <td>{{ $producto->impuesto_id }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
