<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Facturas</title>
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
    <h2>Reporte de Facturas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Subtotal</th>
                <th>Total Impuestos</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Cliente ID</th>
                <th>Método de Pago ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
            <tr>
                <td>{{ $factura->id }}</td>
                <td>{{ $factura->codigo }}</td>
                <td>{{ $factura->subtotal }}</td>
                <td>{{ $factura->total_impuestos }}</td>
                <td>{{ $factura->total }}</td>
                <td>{{ $factura->estado }}</td>
                <td>{{ $factura->cliente_id }}</td>
                <td>{{ $factura->metodo_pago_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
