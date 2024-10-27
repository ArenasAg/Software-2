@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Lista de Impuestos</h1>

    <a href="{{ route('impuestos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Impuesto</a>

    @if($impuestos->isEmpty())
        <p>No hay categorías disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Porcentaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($impuestos as $impuesto)
                <tr>
                    <td>{{ $impuesto->id }}</td>
                    <td>{{ $impuesto->nombre }}</td>
                    <td>{{ $impuesto->porcentaje }}</td>
                    <td>
                        <a href="{{ route('impuestos.edit', $impuesto->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('impuestos.destroy', $impuesto->id) }}" method="POST" style="display:inline;">
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
