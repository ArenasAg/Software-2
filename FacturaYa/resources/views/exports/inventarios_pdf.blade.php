<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Inventarios</title>
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
    <h2>Reporte de Inventarios</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Tipo de Movimiento</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>libro_id</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventarios as $inventario)
            <tr>
                <td>{{ $inventario->id }}</td>
                <td>{{ $inventario->fecha }}</td>
                <td>{{ $inventario->tipo_movimiento }}</td>
                <td>{{ $inventario->entrada }}</td>
                <td>{{ $inventario->salida }}</td>
                <td>{{ $inventario->libro_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
