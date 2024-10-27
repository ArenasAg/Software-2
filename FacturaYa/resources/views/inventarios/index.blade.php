@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Lista de Inventarios</h1>

    <a href="{{ route('inventarios.create') }}" class="btn btn-primary mb-3">Crear Nueva Inventario</a>

    @if($inventarios->isEmpty())
        <p>No hay inventarios disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Tipo de Movimiento</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Producto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventarios as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->fecha }}</td>
                    <td>{{ $categoria->tipo_movimiento }}</td>
                    <td>{{ $categoria->entrada }}</td>
                    <td>{{ $categoria->salida }}</td>
                    <td>{{ $categoria->producto_id }}</td>
                    <td>
                        <a href="{{ route('inventarios.edit', $categoria->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('inventarios.destroy', $categoria->id) }}" method="POST" style="display:inline;">
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
