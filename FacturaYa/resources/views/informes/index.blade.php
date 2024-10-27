@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Lista de Informes</h1>

    <a href="{{ route('informes.create') }}" class="btn btn-primary mb-3">Crear Nuevo Informe</a>

    @if($informes->isEmpty())
        <p>No hay informes disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Tipo de Informe</th>
                    <th>Datos JSON</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($informes as $informe)
                <tr>
                    <td>{{ $informe->id }}</td>
                    <td>{{ $informe->fecha }}</td>
                    <td>
                        @if($informe->tipo_informe == 1)
                            Informe de Ventas
                        @elseif($informe->tipo_informe == 2)
                            Informe de Compras
                        @elseif($informe->tipo_informe == 3)
                            Informe de Inventario
                        @endif
                    </td>
                    <td>{{ $informe->datos_json }}</td>
                    <td>
                        <a href="{{ route('informes.edit', $informe->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('informes.destroy', $informe->id) }}" method="POST" style="display:inline;">
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
