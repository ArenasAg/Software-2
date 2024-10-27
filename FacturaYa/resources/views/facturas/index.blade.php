@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Lista de Facturas</h1>

    <a href="{{ route('facturas.create') }}" class="btn btn-primary mb-3">Crear Nueva Factura</a>

    @if($facturas->isEmpty())
        <p>No hay facturas disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Fecha</th>
                    <th>Subtotal</th>
                    <th>Total Impuestos</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Cliente</th>
                    <th>Método de Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facturas as $factura)
                <tr>
                    <td>{{ $factura->id }}</td>
                    <td>{{ $factura->codigo }}</td>
                    <td>{{ $factura->fecha }}</td>
                    <td>{{ $factura->subtotal }}</td>
                    <td>{{ $factura->total_impuestos }}</td>
                    <td>{{ $factura->total }}</td>
                    <td>
                        @if($factura->estado == true)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>{{ $factura->cliente_id }}</td>
                    <td>{{ $factura->metodo_pago_id }}</td>
                    <td>
                        <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" style="display:inline;">
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
