@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Lista de Detalle Facturas</h1>

    <a href="{{ route('detalleFacturas.create') }}" class="btn btn-primary mb-3">Crear Nuevo Detalle Factura</a>

    @if($detalleFacturas->isEmpty())
        <p>No hay detalle facturas disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>cantidad</th>
                    <th>valor_total</th>
                    <th>descuento</th>
                    <th>producto_id</th>
                    <th>factura_id</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalleFacturas as $detalleFactura)
                <tr>
                    <td>{{ $detalleFactura->id }}</td>
                    <td>{{ $detalleFactura->cantidad }}</td>
                    <td>{{ $detalleFactura->valor_total }}</td>
                    <td>{{ $detalleFactura->descuento }}</td>
                    <td>{{ $detalleFactura->producto_id }}</td>
                    <td>{{ $detalleFactura->factura_id }}</td>
                    <td>
                        <a href="{{ route('detalleFacturas.edit', $detalleFactura->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('detalleFacturas.destroy', $detalleFactura->id) }}" method="POST" style="display:inline;">
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
