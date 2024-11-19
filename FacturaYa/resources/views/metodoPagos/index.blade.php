@extends('layouts.layout')

@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Metodos de Pago</h2>
        <a href="{{ route('metodoPagos.create') }}" class="btn btnAdd" data-bs-toggle="modal" data-bs-target="#newMetodoPagoModal">
            <i class="fas fa-plus"></i> Nuevo Metodo de Pago
        </a>
    </div>

    <div class="card-modern mb-4">
        <div class="row align-items-center">
            <div class="col-md-10">
                <div class="search-container d-flex align-items-center">
                    <i class="fas fa-search search-icon me-2"></i>
                    <input type="text" class="search-modern form-control" id="metodoPagoSearch" placeholder="Buscar metodos de pago...">
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
                        <th>Nombre</th>
                        <th>Identificador</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($metodoPagos->isEmpty())
                        <tr>
                            <td colspan="4">No hay metodos de pago disponibles.</td>
                        </tr>
                    @else
                        @foreach($metodoPagos as $metodoPago)
                        <tr>
                            <td>{{ $metodoPago->id }}</td>
                            <td>{{ $metodoPago->nombre }}</td>
                            <td>{{ $metodoPago->identificador }}</td>
                            <td>
                                <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editMetodoPagoModal" data-id="{{ $metodoPago->id }}" data-nombre="{{ $metodoPago->nombre }}" data-identificador="{{ $metodoPago->identificador }}"><i class="fas fa-edit"></i></button>
                                <form action="{{ route('metodoPagos.destroy', $metodoPago->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este metodo de pago?');"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('metodoPagos.export', ['format' => 'excel']) }}" class="btn btn-success me-2">
                                <i class="fas fa-file-excel"></i> Descargar Excel
                            </a>
                            <a href="{{ route('metodoPagos.export', ['format' => 'pdf']) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Descargar PDF
                            </a>
                        </div>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            {{ $metodoPagos->links('vendor.pagination.simple-tailwind') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Nuevo Metodo de Pago -->
<div class="modal fade" id="newMetodoPagoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Metodo de Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="metodoPagoForm" action="{{ route('metodoPagos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Identificador</label>
                        <input type="text" class="form-control" name="identificador" required>
                    </div>
                    <button type="submit" class="btn btnAdd">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Metodo de Pago -->
<div class="modal fade" id="editMetodoPagoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Metodo de Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editMetodoPagoForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="editMetodoPagoNombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Identificador</label>
                        <input type="text" class="form-control" name="identificador" id="editMetodoPagoIdentificador" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="editMetodoPagoForm">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var metodoPagoForm = document.getElementById('metodoPagoForm');
        metodoPagoForm.addEventListener('submit', function (event) {
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
            .then(response => {
                console.log(response); // Agrega esto para ver la respuesta completa
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    var newMetodoPagoModal = document.getElementById('newMetodoPagoModal');
                    var modal = bootstrap.Modal.getInstance(newMetodoPagoModal);
                    modal.hide();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function fetchMetodoPagos(page = 1) {
            fetch(`/metodoPagos?page=${page}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log(response); // Agrega esto para ver la respuesta completa
                return response.json();
            })
            .then(data => {
                updateTable(data.data);
                updatePagination(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function updateTable(data) {
            var tbody = document.querySelector('tbody');
            if (!tbody) {
                console.error('No se encontró el elemento tbody');
                return;
            }
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4">No hay metodos de pago disponibles.</td></tr>';
            } else {
                data.forEach(function (metodoPago) {
                    var row = `<tr>
                        <td>${metodoPago.id}</td>
                        <td>${metodoPago.nombre}</td>
                        <td>${metodoPago.identificador}</td>
                        <td>
                            <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editMetodoPagoModal" data-id="${metodoPago.id}" data-nombre="${metodoPago.nombre}" data-identificador="${metodoPago.identificador}"><i class="fas fa-edit"></i></button>
                            <form action="/metodoPagos/${metodoPago.id}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este metodo de pago?');"><i class="fas fa-trash"></i></button>
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
                        fetchMetodoPagos(i);
                    });
                    pageItem.appendChild(pageLink);
                    pagination.appendChild(pageItem);
                }
            }
        }

        // Función de búsqueda
        var searchInput = document.getElementById('metodoPagoSearch');
        searchInput.addEventListener('input', function () {
            var query = this.value;
            if (query === '') {
                fetchMetodoPagos();
            } else {
                fetch(`/metodoPagos/search?query=${query}`, {
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
            fetch(`/metodoPagos/filter?sort=${sort}`, {
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

        // Función para editar Metodo de Pago
        var editMetodoPagoModal = document.getElementById('editMetodoPagoModal');
        editMetodoPagoModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nombre = button.getAttribute('data-nombre');
            var identificador = button.getAttribute('data-identificador');

            var modalTitle = editMetodoPagoModal.querySelector('.modal-title');
            var editMetodoPagoNombre = editMetodoPagoModal.querySelector('#editMetodoPagoNombre');
            var editMetodoPagoIdentificador = editMetodoPagoModal.querySelector('#editMetodoPagoIdentificador');

            modalTitle.textContent = 'Editar Metodo de Pago: ' + nombre;
            editMetodoPagoNombre.value = nombre;
            editMetodoPagoIdentificador.value = identificador;

            var editMetodoPagoForm = editMetodoPagoModal.querySelector('#editMetodoPagoForm');
            editMetodoPagoForm.action = `/metodoPagos/${id}`;
        });

        fetchMetodoPagos();
    });
</script>
@endsection
