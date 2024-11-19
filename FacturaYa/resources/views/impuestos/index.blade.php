@extends('layouts.layout')

@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Impuestos</h2>
        <a href="{{ route('impuestos.create') }}" class="btn btnAdd" data-bs-toggle="modal" data-bs-target="#newImpuestoModal">
            <i class="fas fa-plus"></i> Crear Nuevo Impuesto
        </a>
    </div>

    <div class="card-modern mb-4">
        <div class="row align-items-center">
            <div class="col-md-10">
                <div class="search-container d-flex align-items-center">
                    <i class="fas fa-search search-icon me-2"></i>
                    <input type="text" class="search-modern form-control" id="impuestoSearch" placeholder="Buscar impuestos...">
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
                        <button class="btn btnAdd w-100" id="applyFilters">Aplicar Filtros</button>
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
                        <th>Porcentaje</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($impuestos->isEmpty())
                        <tr>
                            <td colspan="4">No hay impuestos disponibles.</td>
                        </tr>
                    @else
                        @foreach($impuestos as $impuesto)
                        <tr>
                            <td>{{ $impuesto->id }}</td>
                            <td>{{ $impuesto->nombre }}</td>
                            <td>{{ $impuesto->porcentaje }}</td>
                            <td>
                                <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editImpuestoModal" data-id="{{ $impuesto->id }}" data-nombre="{{ $impuesto->nombre }}" data-porcentaje="{{ $impuesto->porcentaje }}"><i class="fas fa-edit"></i></button>
                                <form action="{{ route('impuestos.destroy', $impuesto->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este impuesto?');"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('impuestos.export', ['format' => 'excel']) }}" class="btn btn-success me-2">
                                <i class="fas fa-file-excel"></i> Descargar Excel
                            </a>
                            <a href="{{ route('impuestos.export', ['format' => 'pdf']) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Descargar PDF
                            </a>
                        </div>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            {{ $impuestos->links('vendor.pagination.simple-tailwind') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Nuevo Impuesto -->
<div class="modal fade" id="newImpuestoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Impuesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="impuestoForm" action="{{ route('impuestos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Porcentaje</label>
                        <input type="number" class="form-control" name="porcentaje" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="impuestoForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Impuesto -->
<div class="modal fade" id="editImpuestoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Impuesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editImpuestoForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="editImpuestoNombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Porcentaje</label>
                        <input type="number" class="form-control" name="porcentaje" id="editImpuestoPorcentaje" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="editImpuestoForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editImpuestoModal = document.getElementById('editImpuestoModal');
        editImpuestoModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nombre = button.getAttribute('data-nombre');
            var porcentaje = button.getAttribute('data-porcentaje');

            var modalTitle = editImpuestoModal.querySelector('.modal-title');
            var editImpuestoNombre = editImpuestoModal.querySelector('#editImpuestoNombre');
            var editImpuestoPorcentaje = editImpuestoModal.querySelector('#editImpuestoPorcentaje');
            var editImpuestoForm = editImpuestoModal.querySelector('#editImpuestoForm');

            modalTitle.textContent = 'Editar Impuesto: ' + nombre;
            editImpuestoNombre.value = nombre;
            editImpuestoPorcentaje.value = porcentaje;
            editImpuestoForm.action = '/impuestos/' + id;
        });

        var impuestoForm = document.getElementById('impuestoForm');
        impuestoForm.addEventListener('submit', function (event) {
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
                    var newImpuestoModal = document.getElementById('newImpuestoModal');
                    var modal = bootstrap.Modal.getInstance(newImpuestoModal);
                    modal.hide();
                    fetchImpuestos();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function fetchImpuestos(page = 1) {
            fetch(`/impuestos?page=${page}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
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
                tbody.innerHTML = '<tr><td colspan="4">No hay impuestos disponibles.</td></tr>';
            } else {
                data.forEach(function (impuesto) {
                    var row = `<tr>
                        <td>${impuesto.id}</td>
                        <td>${impuesto.nombre}</td>
                        <td>${impuesto.porcentaje}</td>
                        <td>
                            <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editImpuestoModal" data-id="${impuesto.id}" data-nombre="${impuesto.nombre}" data-porcentaje="${impuesto.porcentaje}"><i class="fas fa-edit"></i></button>
                            <form action="/impuestos/${impuesto.id}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este impuesto?');"><i class="fas fa-trash"></i></button>
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
                        fetchImpuestos(i);
                    });
                    pageItem.appendChild(pageLink);
                    pagination.appendChild(pageItem);
                }
            }
        }

        // Función de búsqueda
        var searchInput = document.getElementById('impuestoSearch');
        searchInput.addEventListener('input', function () {
            var query = this.value;
            if (query === '') {
                fetchImpuestos();
            } else {
                fetch(`/impuestos/search?query=${query}`, {
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
            fetch(`/impuestos/filter?sort=${sort}`, {
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

        fetchImpuestos();
    });
</script>
@endsection
