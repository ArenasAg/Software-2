<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Informes</title>
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
    <h2>Reporte de Informes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Tipo de Informe</th>
                <th>Datos JSON</th>
            </tr>
        </thead>
        <tbody>
            @foreach($informes as $informe)
            <tr>
                <td>{{ $informe->id }}</td>
                <td>{{ $informe->fecha }}</td>
                <td>{{ $informe->tipo_informe }}</td>
                <td>{{ $informe->datos_json }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
