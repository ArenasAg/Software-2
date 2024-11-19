<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Métodos de Pago</title>
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
    <h2>Reporte de Métodos de Pago</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($metodoPagos as $metodo)
            <tr>
                <td>{{ $metodo->id }}</td>
                <td>{{ $metodo->nombre }}</td>
                <td>{{ $metodo->created_at }}</td>
                <td>{{ $metodo->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
