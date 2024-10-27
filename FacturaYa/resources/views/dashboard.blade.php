@extends('layouts.layout')

@section('content')
<div class="container">
    <input type="text" class="search-modern" placeholder="Buscar facturas, clientes o productos...">

    <div class="row">
        <div class="col-md-4">
            <div class="stats-card">
                <i class="fas fa-file-invoice fa-2x mb-3"></i>
                <h3>2,547</h3>
                <p>Facturas Emitidas</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <i class="fas fa-users fa-2x mb-3"></i>
                <h3>847</h3>
                <p>Clientes Activos</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <i class="fas fa-dollar-sign fa-2x mb-3"></i>
                <h3>$124,578</h3>
                <p>Ingresos Mensuales</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card-modern">
                <h4>Últimas Facturas</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nº Factura</th>
                                <th>Cliente</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#001</td>
                                <td>Cliente Ejemplo</td>
                                <td>$1,500</td>
                            </tr>
                            <!-- Más filas aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-modern">
                <h4>Clientes Recientes</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Email</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Juan Pérez</td>
                                <td>juan@email.com</td>
                                <td><span class="badge bg-success">Activo</span></td>
                            </tr>
                            <!-- Más filas aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
