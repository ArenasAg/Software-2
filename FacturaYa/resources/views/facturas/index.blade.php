@extends('layouts.layout')

@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Facturas</h2>
        <a href="{{ route('facturas.create') }}" class="btn btnAdd" data-bs-toggle="modal" data-bs-target="#newFacturaModal">
            <i class="fas fa-plus"></i> Crear Nueva Factura
        </a>
    </div>

    <div class="card-modern mb-4">
        <div class="row align-items-center">
            <div class="col-md-10">
                <div class="search-container d-flex align-items-center">
                    <i class="fas fa-search search-icon me-2"></i>
                    <input type="text" class="search-modern form-control" id="facturaSearch" placeholder="Buscar facturas...">
                </div>
            </div>
            <div class="col-md-2 d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-filter"></i> Filtros
                    </button>
                    <div class="dropdown-menu p-3" style="width: 250px;">
                        <div class="mb-3">
                            <label class="form-label">Ordenar por:</label>
                            <select class="form-select" id="sortFilter">
                                <option value="name_asc">Nombre (A-Z)</option>
                                <option value="name_desc">Nombre (Z-A)</option>
                                <option value="recent">Más recientes</option>
                                <option value="oldest">Más antiguos</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-modern">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Total Impuestos</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Cliente</th>
                        <th>Método de Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($facturas->isEmpty())
                        <tr>
                            <td colspan="8">No hay facturas disponibles.</td>
                        </tr>
                    @else
                        @foreach($facturas as $factura)
                        <tr>
                            <td>{{ $factura->id }}</td>
                            <td>{{ $factura->codigo }}</td>
                            <td>{{ $factura->total_impuestos }}</td>
                            <td>{{ $factura->total }}</td>
                            <td>
                                @if($factura->estado == true)
                                    <span class="badge bg-success">Pago</span>
                                @else
                                    <span class="badge bg-secondary">No Pago</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#clienteModal" data-cliente-id="{{ $factura->cliente_id }}">
                                    {{ $clientes->firstWhere('id', $factura->cliente_id)->nombre }}
                                </a>
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#metodoPagoModal" data-metodo-id="{{ $factura->metodo_pago_id }}">
                                    {{ $metodoPagos->firstWhere('id', $factura->metodo_pago_id)->nombre }}
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editFacturaModal" data-id="{{ $factura->id }}" data-codigo="{{ $factura->codigo }}" data-total_impuestos="{{ $factura->total_impuestos }}" data-total="{{ $factura->total }}" data-estado="{{ $factura->estado }}" data-cliente_id="{{ $factura->cliente_id }}" data-metodo_pago_id="{{ $factura->metodo_pago_id }}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detalleFacturaModal" data-id="{{ $factura->id }}"><i class="fas fa-eye"></i></button>
                                <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta factura?');"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('facturas.export', ['format' => 'excel']) }}" class="btn btn-success me-2">
                                <i class="fas fa-file-excel"></i> Descargar Excel
                            </a>
                            <a href="{{ route('facturas.export', ['format' => 'pdf']) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Descargar PDF
                            </a>
                        </div>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            {{ $facturas->links('vendor.pagination.simple-tailwind') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Nueva Factura -->
<div class="modal fade" id="newFacturaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="facturaForm" action="{{ route('facturas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input type="text" class="form-control" name="codigo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Impuestos</label>
                        <input type="number" class="form-control" name="total_impuestos" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total</label>
                        <input type="number" class="form-control" name="total" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="estado" required>
                            <option value="">Seleccione un estado</option>
                            <option value="1">Pago</option>
                            <option value="0">No Pago</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select class="form-select" name="cliente_id" required>
                            <option value="">Seleccione un cliente</option>
                            @if($clientes->isEmpty())
                                <option value="" disabled>No hay clientes disponibles</option>
                            @else
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Método de Pago</label>
                        <select class="form-select" name="metodo_pago_id" required>
                            <option value="">Seleccione un método de pago</option>
                            @if($metodoPagos->isEmpty())
                                <option value="" disabled>No hay metodos de pago disponibles</option>
                            @else
                                @foreach($metodoPagos as $metodo)
                                    <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Libros</label>
                        <div id="libros">
                            <div class="libro-entry">
                                <select name="libro_id[]" class="form-control" required>
                                    @foreach($libros as $libro)
                                        <option value="{{ $libro->id }}">{{ $libro->nombre }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
                                <input type="number" name="descuento[]" class="form-control" placeholder="Descuento" required>
                            </div>
                        </div>
                        <button type="button" id="addLibro" class="btn btn-secondary mt-2">Agregar Libro</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="facturaForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Factura -->
<div class="modal fade" id="editFacturaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editFacturaForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input type="text" class="form-control" name="codigo" id="editFacturaCodigo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Impuestos</label>
                        <input type="number" class="form-control" name="total_impuestos" id="editFacturaTotalImpuestos" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total</label>
                        <input type="number" class="form-control" name="total" id="editFacturaTotal" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="estado" id="editFacturaEstado" required>
                            <option value="">Seleccione un estado</option>
                            <option value="1">Pago</option>
                            <option value="0">No Pago</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select class="form-select" name="cliente_id" id="editFacturaClienteId" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Método de Pago</label>
                        <select class="form-select" name="metodo_pago_id" id="editFacturaMetodoPagoId" required>
                            <option value="">Seleccione un método de pago</option>
                            @foreach($metodoPagos as $metodo)
                                <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Libros</label>
                        <div id="editLibros">
                            <!-- Los libros se llenarán dinámicamente con JavaScript -->
                        </div>
                        <button type="button" id="addEditLibro" class="btn btn-secondary mt-2">Agregar Libro</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="editFacturaForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Detalle de Factura -->
<div class="modal fade" id="detalleFacturaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle de Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul id="detalleFacturaList">
                    <!-- Los detalles de la factura se llenarán dinámicamente con JavaScript -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var facturaForm = document.getElementById('facturaForm');
        facturaForm.addEventListener('submit', function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            var action = this.action;

            fetch(action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var newFacturaModal = document.getElementById('newFacturaModal');
                    var modal = bootstrap.Modal.getInstance(newFacturaModal);
                    modal.hide();
                    fetchFacturas();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function fetchFacturas(page = 1) {
            fetch(`/facturas?page=${page}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                updateTable(data.facturas.data, data.clientes, data.metodoPagos);
                updatePagination(data.facturas);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function updateTable(facturas, clientes, metodoPagos) {
            var tbody = document.querySelector('tbody');
            if (!tbody) {
                console.error('No se encontró el elemento tbody');
                return;
            }
            tbody.innerHTML = '';

            if (facturas.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8">No hay facturas disponibles.</td></tr>';
            } else {
                facturas.forEach(function (factura) {
                    $cliente = clientes.find(cliente => cliente.id === factura.cliente_id);
                    $metodoPago = metodoPagos.find(metodo => metodo.id === factura.metodo_pago_id);
                    var row = `<tr>
                        <td>${factura.id}</td>
                        <td>${factura.codigo}</td>
                        <td>${factura.total_impuestos}</td>
                        <td>${factura.total}</td>
                        <td>
                            ${factura.estado ? '<span class="badge bg-success">Pago</span>' : '<span class="badge bg-secondary">No Pago</span>'}
                        </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#clienteModal" data-cliente-id="${factura.cliente_id}">
                                ${$cliente ? $cliente.nombre : 'N/A'}
                            </a>
                        </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#metodoPagoModal" data-metodo-id="${factura.metodo_pago_id}">
                                ${$metodoPago ? $metodoPago.nombre : 'N/A'}
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editFacturaModal" data-id="${factura.id}" data-codigo="${factura.codigo}" data-total_impuestos="${factura.total_impuestos}" data-total="${factura.total}" data-estado="${factura.estado}" data-cliente_id="${factura.cliente_id}" data-metodo_pago_id="${factura.metodo_pago_id}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detalleFacturaModal" data-id="${factura.id}"><i class="fas fa-eye"></i></button>
                            <form action="/facturas/${factura.id}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta factura?');"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>`;
                    tbody.innerHTML += row;
                });
            }
        }

        function updatePagination(data) {
            var pagination = document.querySelector('.pagination');
            if (!pagination) {
                console.error('No se encontró el elemento pagination');
                return;
            }
            pagination.innerHTML = '';

            if (data.total > data.per_page) {
                for (let i = 1; i <= data.last_page; i++) {
                    let pageItem = document.createElement('li');
                    pageItem.classList.add('page-item');
                    if (i === data.current_page) {
                        pageItem.classList.add('active');
                    }
                    let pageLink = document.createElement('a');
                    pageLink.classList.add('page-link');
                    pageLink.href = '#';
                    pageLink.textContent = i;
                    pageLink.addEventListener('click', function (event) {
                        event.preventDefault();
                        fetchFacturas(i);
                    });
                    pageItem.appendChild(pageLink);
                    pagination.appendChild(pageItem);
                }
            }
        }

        // Función de búsqueda
        var searchInput = document.getElementById('facturaSearch');
        searchInput.addEventListener('input', function () {
            var query = this.value;
            if (query === '') {
                fetchFacturas();
            } else {
                fetch(`/facturas/search?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateTable(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });

        // Función de filtro
        var sortFilter = document.getElementById('sortFilter');
        sortFilter.addEventListener('change', function () {
            var sort = this.value;
            fetch(`/facturas/filter?sort=${sort}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                updateTable(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Función para editar Factura
        var editFacturaModal = document.getElementById('editFacturaModal');
        editFacturaModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var codigo = button.getAttribute('data-codigo');
            var total_impuestos = button.getAttribute('data-total_impuestos');
            var total = button.getAttribute('data-total');
            var estado = button.getAttribute('data-estado');
            var cliente_id = button.getAttribute('data-cliente_id');
            var metodo_pago_id = button.getAttribute('data-metodo_pago_id');

            var editFacturaForm = editFacturaModal.querySelector('#editFacturaForm');
            editFacturaForm.action = `/facturas/${id}`;

            var editFacturaCodigo = editFacturaModal.querySelector('#editFacturaCodigo');
            var editFacturaTotalImpuestos = editFacturaModal.querySelector('#editFacturaTotalImpuestos');
            var editFacturaTotal = editFacturaModal.querySelector('#editFacturaTotal');
            var editFacturaEstado = editFacturaModal.querySelector('#editFacturaEstado');
            var editFacturaClienteId = editFacturaModal.querySelector('#editFacturaClienteId');
            var editFacturaMetodoPagoId = editFacturaModal.querySelector('#editFacturaMetodoPagoId');

            editFacturaCodigo.value = codigo;
            editFacturaTotalImpuestos.value = total_impuestos;
            editFacturaTotal.value = total;
            editFacturaEstado.value = estado;
            editFacturaClienteId.value = cliente_id;
            editFacturaMetodoPagoId.value = metodo_pago_id;
        });

        // Función para mostrar detalles de la factura
        var detalleFacturaModal = document.getElementById('detalleFacturaModal');
        detalleFacturaModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');

            fetch(`/facturas/${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                var detalleFacturaList = detalleFacturaModal.querySelector('#detalleFacturaList');
                detalleFacturaList.innerHTML = '';

                data.detalles.forEach(function (detalle) {
                    var listItem = document.createElement('li');
                    listItem.innerHTML = `${detalle.libro.nombre}<br>
                        <ul style="margin-left: 20px;">
                            <li>Cantidad: ${detalle.cantidad}</li><br>
                            <li>Precio Unitario: ${detalle.precio_unitario}</li><br>
                            <li>Descuento: ${detalle.descuento}</li><br>
                            <li>Total: ${detalle.valor_total}</li>
                        </ul>`;
                    detalleFacturaList.appendChild(listItem);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        fetchFacturas();
    });
</script>
@endsection
