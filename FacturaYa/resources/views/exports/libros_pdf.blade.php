<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Libros</title>
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
    <h2>Reporte de Libros</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Medida</th>
                <th>Categoría ID</th>
                <th>Impuesto ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($libros as $libro)
            <tr>
                <td>{{ $libro->id }}</td>
                <td>{{ $libro->codigo }}</td>
                <td>{{ $libro->nombre }}</td>
                <td>{{ $libro->precio }}</td>
                <td>{{ $libro->medida }}</td>
                <td>{{ $libro->categoria_id }}</td>
                <td>{{ $libro->impuesto_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
