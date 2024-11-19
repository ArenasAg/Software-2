@extends('layouts.layout')

@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Informes</h2>
        <a href="{{ route('informes.create') }}" class="btn btnAdd" data-bs-toggle="modal" data-bs-target="#newInformeModal">
            <i class="fas fa-plus"></i> Crear Nuevo Informe
        </a>
    </div>

    <div class="card-modern mb-4">
        <div class="row align-items-center">
            <div class="col-md-10">
                <div class="search-container d-flex align-items-center">
                    <i class="fas fa-search search-icon me-2"></i>
                    <input type="text" class="search-modern form-control" id="informeSearch" placeholder="Buscar informes...">
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
                                <option value="type">Tipo de Informe</option>
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
                        <th>Tipo de Informe</th>
                        <th>Datos JSON</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($informes->isEmpty())
                        <tr>
                            <td colspan="5">No hay informes disponibles.</td>
                        </tr>
                    @else
                        @foreach($informes as $informe)
                        <tr>
                            <td>{{ $informe->id }}</td>
                            <td>{{ $informe->fecha }}</td>
                            <td>
                                @if($informe->tipo_informe == 1)
                                    Informe de Ventas
                                @elseif($informe->tipo_informe == 2)
                                    Informe de Compras
                                @elseif($informe->tipo_informe == 3)
                                    Informe de Inventario
                                @endif
                            </td>
                            <td>{{ $informe->datos_json }}</td>
                            <td>
                                <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editInformeModal" data-id="{{ $informe->id }}" data-fecha="{{ $informe->fecha }}" data-tipo_informe="{{ $informe->tipo_informe }}" data-datos_json="{{ $informe->datos_json }}"><i class="fas fa-edit"></i></button>
                                <form action="{{ route('informes.destroy', $informe->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este informe?');"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('informes.export', ['format' => 'excel']) }}" class="btn btn-success me-2">
                                <i class="fas fa-file-excel"></i> Descargar Excel
                            </a>
                            <a href="{{ route('informes.export', ['format' => 'pdf']) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Descargar PDF
                            </a>
                        </div>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            {{ $informes->links('vendor.pagination.simple-tailwind') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Nuevo Informe -->
<div class="modal fade" id="newInformeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Informe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="informeForm" action="{{ route('informes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de Informe</label>
                        <select class="form-select" name="tipo_informe" required>
                            <option value="1">Informe de Ventas</option>
                            <option value="2">Informe de Compras</option>
                            <option value="3">Informe de Inventario</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Datos JSON</label>
                        <textarea class="form-control" name="datos_json" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="informeForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Informe -->
<div class="modal fade" id="editInformeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Informe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editInformeForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="editInformeFecha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de Informe</label>
                        <select class="form-select" name="tipo_informe" id="editInformeTipoInforme" required>
                            <option value="1">Informe de Ventas</option>
                            <option value="2">Informe de Compras</option>
                            <option value="3">Informe de Inventario</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Datos JSON</label>
                        <textarea class="form-control" name="datos_json" id="editInformeDatosJson" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="editInformeForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editInformeModal = document.getElementById('editInformeModal');
        editInformeModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var fecha = button.getAttribute('data-fecha');
            var tipo_informe = button.getAttribute('data-tipo_informe');
            var datos_json = button.getAttribute('data-datos_json');

            var modalTitle = editInformeModal.querySelector('.modal-title');
            var editInformeFecha = editInformeModal.querySelector('#editInformeFecha');
            var editInformeTipoInforme = editInformeModal.querySelector('#editInformeTipoInforme');
            var editInformeDatosJson = editInformeModal.querySelector('#editInformeDatosJson');
            var editInformeForm = editInformeModal.querySelector('#editInformeForm');

            modalTitle.textContent = 'Editar Informe: ' + id;
            editInformeFecha.value = fecha;
            editInformeTipoInforme.value = tipo_informe;
            editInformeDatosJson.value = datos_json;
            editInformeForm.action = '/informes/' + id;
        });

        var informeForm = document.getElementById('informeForm');
        informeForm.addEventListener('submit', function (event) {
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
                    var newInformeModal = document.getElementById('newInformeModal');
                    var modal = bootstrap.Modal.getInstance(newInformeModal);
                    modal.hide();
                    fetchInformes();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function fetchInformes(page = 1) {
            fetch(`/informes?page=${page}`, {
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
                tbody.innerHTML = '<tr><td colspan="5">No hay informes disponibles.</td></tr>';
            } else {
                data.forEach(function (informe) {
                    var row = `<tr>
                        <td>${informe.id}</td>
                        <td>${informe.fecha}</td>
                        <td>${informe.tipo_informe}</td>
                        <td>${informe.datos_json}</td>
                        <td>
                            <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editInformeModal" data-id="${informe.id}" data-fecha="${informe.fecha}" data-tipo_informe="${informe.tipo_informe}" data-datos_json="${informe.datos_json}"><i class="fas fa-edit"></i></button>
                            <form action="/informes/${informe.id}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este informe?');"><i class="fas fa-trash"></i></button>
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
                        fetchInformes(i);
                    });
                    pageItem.appendChild(pageLink);
                    pagination.appendChild(pageItem);
                }
            }
        }

        // Función de búsqueda
        var searchInput = document.getElementById('informeSearch');
        searchInput.addEventListener('input', function () {
            var query = this.value;
            if (query === '') {
                fetchInformes();
            } else {
                fetch(`/informes/search?query=${query}`, {
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
            fetch(`/informes/filter?sort=${sort}`, {
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

        fetchInformes();
    });
</script>
@endsection
