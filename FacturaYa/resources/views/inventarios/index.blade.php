@extends('layouts.layout')

@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Inventarios</h2>
        <a href="{{ route('inventarios.create') }}" class="btn btnAdd" data-bs-toggle="modal" data-bs-target="#newInventoryModal">
            <i class="fas fa-plus"></i> Crear Nuevo Inventario
        </a>
    </div>

    <div class="card-modern mb-4">
        <div class="row align-items-center">
            <div class="col-md-10">
                <div class="search-container d-flex align-items-center">
                    <i class="fas fa-search search-icon me-2"></i>
                    <input type="text" class="search-modern form-control" id="inventorySearch" placeholder="Buscar inventarios...">
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
                                <option value="date_asc">Fecha (Ascendente)</option>
                                <option value="date_desc">Fecha (Descendente)</option>
                                <option value="type">Tipo de Movimiento</option>
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
                        <th>Fecha</th>
                        <th>Tipo de Movimiento</th>
                        <th>Libros</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($inventarios->isEmpty())
                        <tr>
                            <td colspan="5">No hay inventarios disponibles.</td>
                        </tr>
                    @else
                        @foreach($inventarios as $inventario)
                        <tr>
                            <td>{{ $inventario->id }}</td>
                            <td>{{ $inventario->fecha }}</td>
                            <td>{{ $inventario->tipo_movimiento }}</td>
                            <td>
                                <ul>
                                    @foreach($inventario->detalles as $detalle)
                                        <li>{{ $detalle->libro->nombre }} (Cantidad: {{ $detalle->cantidad }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editInventoryModal" data-id="{{ $inventario->id }}" data-fecha="{{ $inventario->fecha }}" data-tipo_movimiento="{{ $inventario->tipo_movimiento }}" data-libros="{{ $inventario->detalles->pluck('libro.nombre')->implode(', ') }}"><i class="fas fa-edit"></i></button>
                                <form action="{{ route('inventarios.destroy', $inventario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este inventario?');"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('inventarios.export', ['format' => 'excel']) }}" class="btn btn-success me-2">
                                <i class="fas fa-file-excel"></i> Descargar Excel
                            </a>
                            <a href="{{ route('inventarios.export', ['format' => 'pdf']) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Descargar PDF
                            </a>
                        </div>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            {{ $inventarios->links('vendor.pagination.simple-tailwind') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Nuevo Inventario -->
<div class="modal fade" id="newInventoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Inventario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="inventoryForm" action="{{ route('inventarios.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de Movimiento</label>
                        <select name="tipo_movimiento" class="form-control" required>
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
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
                            </div>
                        </div>
                        <button type="button" id="addLibro" class="btn btn-secondary mt-2">Agregar Libro</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="inventoryForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Inventario -->
<div class="modal fade" id="editInventoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Inventario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editInventoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="editInventoryFecha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de Movimiento</label>
                        <select name="tipo_movimiento" class="form-control" id="editInventoryTipoMovimiento" required>
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
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
                <button type="submit" class="btn btnAdd" form="editInventoryForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Libro -->
<div class="modal fade" id="libroModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información del Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="libroInfo"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editInventoryModal = document.getElementById('editInventoryModal');
        editInventoryModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var fecha = button.getAttribute('data-fecha');
            var tipo_movimiento = button.getAttribute('data-tipo_movimiento');
            var libros = button.getAttribute('data-libros');

            var modalTitle = editInventoryModal.querySelector('.modal-title');
            var editInventoryFecha = editInventoryModal.querySelector('#editInventoryFecha');
            var editInventoryTipoMovimiento = editInventoryModal.querySelector('#editInventoryTipoMovimiento');
            var editLibrosDiv = editInventoryModal.querySelector('#editLibros');
            var editInventoryForm = editInventoryModal.querySelector('#editInventoryForm');

            modalTitle.textContent = 'Editar Inventario: ' + id;
            editInventoryFecha.value = fecha;
            editInventoryTipoMovimiento.value = tipo_movimiento;
            editLibrosDiv.innerHTML = '';

            var librosArray = libros.split(', ');
            librosArray.forEach(function(libro) {
                var libroEntry = document.createElement('div');
                libroEntry.classList.add('libro-entry');
                libroEntry.innerHTML = `
                    <select name="libro_id[]" class="form-control" required>
                        @foreach($libros as $libro)
                            <option value="{{ $libro->id }}" ${libro === '{{ $libro->nombre }}' ? 'selected' : ''}>{{ $libro->nombre }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
                `;
                editLibrosDiv.appendChild(libroEntry);
            });

            editInventoryForm.action = '/inventarios/' + id;
        });

        var libroModal = document.getElementById('libroModal');
        libroModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var libroId = button.getAttribute('data-libro-id');
            var libro = json($libros).find(libro => libro.id == libroId);
            var libroInfo = libroModal.querySelector('#libroInfo');
            libroInfo.textContent = 'Nombre: ' + libro.nombre + ', Descripción: ' + libro.descripcion;
        });

        // Función de búsqueda
        var searchInput = document.getElementById('inventorySearch');
        searchInput.addEventListener('input', function () {
            var query = this.value;
            if (query === '') {
                fetchInventarios();
            } else {
                fetch(`/inventarios/search?query=${query}`, {
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
            fetch(`/inventarios/filter?sort=${sort}`, {
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

        function fetchInventarios(page = 1) {
            fetch(`/inventarios?page=${page}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                updateTable(data.inventarios.data, data.libros);
                updatePagination(data.inventarios);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function updateTable(inventarios, libros) {
            var tbody = document.querySelector('tbody');
            if (!tbody) {
                console.error('No se encontró el elemento tbody');
                return;
            }
            tbody.innerHTML = '';

            if (inventarios.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7">No hay inventarios disponibles.</td></tr>';
            } else {
                inventarios.forEach(function (inventario) {
                    var row = `<tr>
                        <td>${inventario.id}</td>
                        <td>${inventario.fecha}</td>
                        <td>${inventario.tipo_movimiento}</td>
                        <td>
                            <ul>
                                ${inventario.detalles.map(detalle => `<li>${detalle.libro.nombre} (Cantidad: ${detalle.cantidad})</li>`).join('')}
                            </ul>
                        </td>
                        <td>
                            <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editInventoryModal" data-id="${inventario.id}" data-fecha="${inventario.fecha}" data-tipo_movimiento="${inventario.tipo_movimiento}" data-libros="${inventario.detalles.map(detalle => detalle.libro.nombre).join(', ')}"><i class="fas fa-edit"></i></button>
                            <form action="/inventarios/${inventario.id}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este inventario?');"><i class="fas fa-trash"></i></button>
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
                        fetchInventarios(i);
                    });
                    pageItem.appendChild(pageLink);
                    pagination.appendChild(pageItem);
                }
            }
        }

        document.getElementById('addLibro').addEventListener('click', function() {
            var librosDiv = document.getElementById('libros');
            var newEntry = document.createElement('div');
            newEntry.classList.add('libro-entry');
            newEntry.innerHTML = `
                <select name="libro_id[]" class="form-control" required>
                    @foreach($libros as $libro)
                        <option value="{{ $libro->id }}">{{ $libro->nombre }}</option>
                    @endforeach
                </select>
                <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
            `;
            librosDiv.appendChild(newEntry);
        });

        document.getElementById('addEditLibro').addEventListener('click', function() {
            var editLibrosDiv = document.getElementById('editLibros');
            var newEntry = document.createElement('div');
            newEntry.classList.add('libro-entry');
            newEntry.innerHTML = `
                <select name="libro_id[]" class="form-control" required>
                    @foreach($libros as $libro)
                        <option value="{{ $libro->id }}">{{ $libro->nombre }}</option>
                    @endforeach
                </select>
                <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
            `;
            editLibrosDiv.appendChild(newEntry);
        });

        fetchInventarios();
    });
</script>
@endsection
