<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Facturas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Detalle de Facturas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cantidad</th>
                <th>Valor Total</th>
                <th>Descuento</th>
                <th>Libro ID</th>
                <th>Factura ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalleFacturas as $detalle)
            <tr>
                <td>{{ $detalle->id }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ $detalle->valor_total }}</td>
                <td>{{ $detalle->descuento }}</td>
                <td>{{ $detalle->libro_id }}</td>
                <td>{{ $detalle->factura_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
