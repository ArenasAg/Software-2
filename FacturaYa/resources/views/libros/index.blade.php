@extends('layouts.layout')

@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Libros</h2>
        <a href="{{ route('libros.create') }}" class="btn btnAdd" data-bs-toggle="modal" data-bs-target="#newProductModal">
            <i class="fas fa-plus"></i> Crear Nuevo Libro
        </a>
    </div>

    <div class="card-modern mb-4">
        <div class="row align-items-center">
            <div class="col-md-10">
                <div class="search-container d-flex align-items-center">
                    <i class="fas fa-search search-icon me-2"></i>
                    <input type="text" class="search-modern form-control" id="libroSearch" placeholder="Buscar libros...">
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
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Precio de Venta</th>
                        <th>Medida</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Impuesto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($libros->isEmpty())
                        <tr>
                            <td colspan="10">No hay libros disponibles.</td>
                        </tr>
                    @else
                        @foreach($libros as $libro)
                        <tr>
                            <td>{{ $libro->id }}</td>
                            <td>{{ $libro->codigo }}</td>
                            <td>{{ $libro->nombre }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $libro->imagen) }}" alt="{{ $libro->nombre }}" width="50">
                            </td>
                            <td>{{ $libro->precio }}</td>
                            <td>{{ $libro->medida }}</td>
                            <td>{{ $libro->stock }}</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#categoriaModal" data-categoria-id="{{ $libro->categoria_id }}">
                                    {{ $categorias->firstWhere('id', $libro->categoria_id)->nombre }}
                                </a>
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#impuestoModal" data-impuesto-id="{{ $libro->impuesto_id }}">
                                    {{ $impuestos->firstWhere('id', $libro->impuesto_id)->nombre }}
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="{{ $libro->id }}" data-codigo="{{ $libro->codigo }}" data-nombre="{{ $libro->nombre }}" data-precio="{{ $libro->precio }}" data-medida="{{ $libro->medida }}" data-stock="{{ $libro->stock }}" data-categoria_id="{{ $libro->categoria_id }}" data-impuesto_id="{{ $libro->impuesto_id }}"><i class="fas fa-edit"></i></button>
                                <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?');"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('libros.export', ['format' => 'excel']) }}" class="btn btn-success me-2">
                                <i class="fas fa-file-excel"></i> Descargar Excel
                            </a>
                            <a href="{{ route('libros.export', ['format' => 'pdf']) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Descargar PDF
                            </a>
                        </div>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            <div class="d-flex justify-content-center">
                                {{ $libros->links('vendor.pagination.simple-tailwind') }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Nuevo Libro -->
<div class="modal fade" id="newProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input type="text" class="form-control" name="codigo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="imagen" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio de Venta</label>
                        <input type="number" class="form-control" name="precio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Medida</label>
                        <input type="text" class="form-control" name="medida" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" name="categoria_id" required>
                            <option value="">Seleccione una categoría</option>
                            @if($categorias->isEmpty())
                                <option value="" disabled>No hay categorías disponibles</option>
                            @else
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Impuesto</label>
                        <select class="form-select" name="impuesto_id" required>
                            <option value="">Seleccione un impuesto</option>
                            @if($impuestos->isEmpty())
                                <option value="" disabled>No hay impuestos disponibles</option>
                            @else
                                @foreach($impuestos as $impuesto)
                                    <option value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="productForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Libro -->
<div class="modal fade" id="editProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input type="text" class="form-control" name="codigo" id="editProductCodigo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="editProductNombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="imagen" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio de Venta</label>
                        <input type="number" class="form-control" name="precio" id="editProductPrecio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Medida</label>
                        <input type="text" class="form-control" name="medida" id="editProductMedida" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" id="editProductStock" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" name="categoria_id" id="editProductCategoriaId" required>
                            <option value="">Seleccione una categoría</option>
                            @if($categorias->isEmpty())
                                <option value="" disabled>No hay categorías disponibles</option>
                            @else
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Impuesto</label>
                        <select class="form-select" name="impuesto_id" id="editProductImpuestoId" required>
                            <option value="">Seleccione un impuesto</option>
                            @if($impuestos->isEmpty())
                                <option value="" disabled>No hay impuestos disponibles</option>
                            @else
                                @foreach($impuestos as $impuesto)
                                    <option value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="editProductForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Categoría -->
<div class="modal fade" id="categoriaModal" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Información de la Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" id="categoriaNombre" disabled>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<!-- Modal para Impuesto -->
<div class="modal fade" id="impuestoModal" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Información del Impuesto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" id="impuestoNombre" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Porcentaje</label>
            <input type="text" class="form-control" id="impuestoPorcentaje" disabled>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var productForm = document.getElementById('productForm');
        productForm.addEventListener('submit', function (event) {
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
                    var newProductModal = document.getElementById('newProductModal');
                    var modal = bootstrap.Modal.getInstance(newProductModal);
                    modal.hide();
                    fetchLibros();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        var editProductModal = document.getElementById('editProductModal');
        editProductModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var codigo = button.getAttribute('data-codigo');
            var nombre = button.getAttribute('data-nombre');
            var precio = button.getAttribute('data-precio');
            var medida = button.getAttribute('data-medida');
            var stock = button.getAttribute('data-stock');
            var categoria_id = button.getAttribute('data-categoria_id');
            var impuesto_id = button.getAttribute('data-impuesto_id');

            var modalTitle = editProductModal.querySelector('.modal-title');
            var editProductCodigo = editProductModal.querySelector('#editProductCodigo');
            var editProductNombre = editProductModal.querySelector('#editProductNombre');
            var editProductPrecio = editProductModal.querySelector('#editProductPrecio');
            var editProductMedida = editProductModal.querySelector('#editProductMedida');
            var editProductStock = editProductModal.querySelector('#editProductStock');
            var editProductCategoria = editProductModal.querySelector('#editProductCategoriaId');
            var editProductImpuesto = editProductModal.querySelector('#editProductImpuestoId');

            modalTitle.textContent = 'Editar Libro: ' + nombre;
            editProductCodigo.value = codigo;
            editProductNombre.value = nombre;
            editProductPrecio.value = precio;
            editProductMedida.value = medida;
            editProductStock.value = stock;
            editProductCategoria.value = categoria_id;
            editProductImpuesto.value = impuesto_id;

            var editProductForm = editProductModal.querySelector('#editProductForm');
            editProductForm.action = `/libros/${id}`;
        });

        function fetchLibros(page = 1) {
            fetch(`/libros?page=${page}`, {
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
                updateTable(data.libros.data, data.categorias, data.impuestos);
                updatePagination(data.libros);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function updateTable(libros, categorias, impuestos) {
            var tbody = document.querySelector('tbody');
            if (!tbody) {
                console.error('No se encontró el elemento tbody');
                return;
            }
            tbody.innerHTML = '';

            if (libros.length === 0) {
                tbody.innerHTML = '<tr><td colspan="10">No hay libros disponibles.</td></tr>';
            } else {
                libros.forEach(function (libro) {
                    var categoria = categorias.find(categoria => categoria.id === libro.categoria_id);
                    var impuesto = impuestos.find(impuesto => impuesto.id === libro.impuesto_id);
                    var row = `<tr>
                        <td>${libro.id}</td>
                        <td>${libro.codigo}</td>
                        <td>${libro.nombre}</td>
                        <td><img src="/storage/${libro.imagen}" alt="${libro.nombre}" width="50"></td>
                        <td>${libro.precio}</td>
                        <td>${libro.medida}</td>
                        <td>${libro.stock}</td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#categoriaModal" data-categoria-id="${libro.categoria_id}">
                                ${categoria ? categoria.nombre : 'N/A'}
                            </a>
                        </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#impuestoModal" data-impuesto-id="${libro.impuesto_id}">
                                ${impuesto ? impuesto.nombre : 'N/A'}
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="${libro.id}" data-codigo="${libro.codigo}" data-nombre="${libro.nombre}" data-precio="${libro.precio}" data-medida="${libro.medida}" data-stock="${libro.stock}" data-categoria_id="${libro.categoria_id}" data-impuesto_id="${libro.impuesto_id}"><i class="fas fa-edit"></i></button>
                            <form action="/libros/${libro.id}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?');"><i class="fas fa-trash"></i></button>
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
                        fetchLibros(i);
                    });
                    pageItem.appendChild(pageLink);
                    pagination.appendChild(pageItem);
                }
            }
        }

        // Función de búsqueda
        var searchInput = document.getElementById('libroSearch');
        searchInput.addEventListener('input', function () {
            var query = this.value;
            if (query === '') {
                fetchLibros();
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

        fetchLibros();
    });
</script>
@endsection
