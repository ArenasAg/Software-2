<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Impuestos</title>
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
    <h2>Reporte de Impuestos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($impuestos as $impuesto)
            <tr>
                <td>{{ $impuesto->id }}</td>
                <td>{{ $impuesto->nombre }}</td>
                <td>{{ $impuesto->porcentaje }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
