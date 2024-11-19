@extends('layouts.layout')

@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Clientes</h2>
        <a href="{{ route('clientes.create') }}" class="btn btnAdd" data-bs-toggle="modal" data-bs-target="#newClientModal">
            <i class="fas fa-plus"></i> Crear Nuevo Cliente
        </a>
    </div>

    <div class="card-modern mb-4">
        <div class="row align-items-center">
            <div class="col-md-10">
                <div class="search-container d-flex align-items-center">
                    <i class="fas fa-search search-icon me-2"></i>
                    <input type="text" class="search-modern form-control" id="clientSearch" placeholder="Buscar clientes...">
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
                        <th>Numero de documento</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Ciudad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($clientes->isEmpty())
                        <tr>
                            <td colspan="8">No hay clientes disponibles.</td>
                        </tr>
                    @else
                        @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->numero_documento }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->ciudad }}</td>
                            <td>
                                <button class="btn btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#editClientModal" data-id="{{ $cliente->id }}" data-nombre="{{ $cliente->nombre }}" data-numero_documento="{{ $cliente->numero_documento }}" data-direccion="{{ $cliente->direccion }}" data-telefono="{{ $cliente->telefono }}" data-email="{{ $cliente->email }}" data-ciudad="{{ $cliente->ciudad }}"><i class="fas fa-edit"></i></button>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('clientes.export', ['format' => 'excel']) }}" class="btn btn-success me-2">
                                <i class="fas fa-file-excel"></i> Descargar Excel
                            </a>
                            <a href="{{ route('clientes.export', ['format' => 'pdf']) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Descargar PDF
                            </a>
                        </div>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            {{ $clientes->links('vendor.pagination.simple-tailwind') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Nuevo Cliente -->
<div class="modal fade" id="newClientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="clientForm" action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Numero de documento</label>
                        <input type="text" class="form-control" name="numero_documento" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Direccion</label>
                        <input type="text" class="form-control" name="direccion" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="text" class="form-control" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" required>
                    </div>
                    <button type="submit" class="btn btnAdd">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Cliente -->
<div class="modal fade" id="editClientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editClientForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Numero de documento</label>
                        <input type="text" class="form-control" name="numero_documento" id="editClientNumeroDocumento" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="editClientNombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Direccion</label>
                        <input type="text" class="form-control" name="direccion" id="editClientDireccion" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="text" class="form-control" name="telefono" id="editClientTelefono" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="editClientEmail" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" id="editClientCiudad" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btnAdd" form="editClientForm">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editClientModal = document.getElementById('editClientModal');
        editClientModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var numero_documento = button.getAttribute('data-numero_documento');
            var nombre = button.getAttribute('data-nombre');
            var direccion = button.getAttribute('data-direccion');
            var telefono = button.getAttribute('data-telefono');
            var email = button.getAttribute('data-email');
            var ciudad = button.getAttribute('data-ciudad');

            var modalTitle = editClientModal.querySelector('.modal-title');
            var editClientNumeroDocumento = editClientModal.querySelector('#editClientNumeroDocumento');
            var editClientNombre = editClientModal.querySelector('#editClientNombre');
            var editClientDireccion = editClientModal.querySelector('#editClientDireccion');
            var editClientTelefono = editClientModal.querySelector('#editClientTelefono');
            var editClientEmail = editClientModal.querySelector('#editClientEmail');
            var editClientCiudad = editClientModal.querySelector('#editClientCiudad');
            var editClientForm = editClientModal.querySelector('#editClientForm');

            modalTitle.textContent = 'Editar Cliente: ' + nombre;
            editClientNumeroDocumento.value = numero_documento;
            editClientNombre.value = nombre;
            editClientDireccion.value = direccion;
            editClientTelefono.value = telefono;
            editClientEmail.value = email;
            editClientCiudad.value = ciudad;
            editClientForm.action = '/clientes/' + id;
        });
    });
</script>
@endsection
