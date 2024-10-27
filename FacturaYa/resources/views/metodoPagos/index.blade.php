@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Lista de Metodos de Pago</h1>

    <a href="{{ route('metodoPagos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Metodo de Pago</a>

    @if($metodoPagos->isEmpty())
        <p>No hay metodos de pago disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Identificador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($metodoPagos as $metodoPago)
                <tr>
                    <td>{{ $metodoPago->id }}</td>
                    <td>{{ $metodoPago->descripcion }}</td>
                    <td>{{ $metodoPago->identificador }}</td>
                    <td>
                        <a href="{{ route('metodoPagos.edit', $metodoPago->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('metodoPagos.destroy', $metodoPago->id) }}" method="POST" style="display:inline;">
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
