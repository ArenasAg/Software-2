@extends('layouts.layout')

@section('title', 'Crear Cliente')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('clientes.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Clientes
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Crear Cliente</li>
        </ol>
    </nav>

    <h2 class="page-title">Crear Nuevo Cliente</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Cliente</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="numero_documento" class="form-label required-field">
                        Numero de documento
                    </label>
                    <input
                        type="text"
                        class="form-control @error('numero_documento') is-invalid @enderror"
                        id="numero_documento"
                        name="numero_documento"
                        placeholder="Ingrese el número de documento"
                        required
                        value="{{ old('numero_documento') }}"
                    >
                    @error('numero_documento')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nombre" class="form-label required-field">
                        Nombre
                    </label>
                    <input
                        type="text"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        name="nombre"
                        placeholder="Ingrese el nombre"
                        required
                        value="{{ old('nombre') }}"
                    >
                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="direccion" class="form-label required-field">
                        Dirección
                    </label>
                    <input
                        type="text"
                        class="form-control @error('direccion') is-invalid @enderror"
                        id="direccion"
                        name="direccion"
                        placeholder="Ingrese la dirección"
                        required
                        value="{{ old('direccion') }}"
                    >
                    @error('direccion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="telefono" class="form-label required-field">
                        Teléfono
                    </label>
                    <input
                        type="text"
                        class="form-control @error('telefono') is-invalid @enderror"
                        id="telefono"
                        name="telefono"
                        placeholder="Ingrese el teléfono"
                        required
                        value="{{ old('telefono') }}"
                    >
                    @error('telefono')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label required-field">
                        Email
                    </label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        placeholder="Ingrese el email"
                        required
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="ciudad" class="form-label required-field">
                        Ciudad
                    </label>
                    <select
                        class="form-control @error('ciudad') is-invalid @enderror"
                        id="ciudad"
                        name="ciudad"
                        required
                    >
                        <option value="">Seleccione una ciudad</option>
                        <option value="Bogotá" {{ old('ciudad') == 'Bogotá' ? 'selected' : '' }}>Bogotá</option>
                        <option value="Medellín" {{ old('ciudad') == 'Medellín' ? 'selected' : '' }}>Medellín</option>
                        <option value="Cali" {{ old('ciudad') == 'Cali' ? 'selected' : '' }}>Cali</option>
                        <option value="Barranquilla" {{ old('ciudad') == 'Barranquilla' ? 'selected' : '' }}>Barranquilla</option>
                        <option value="Cartagena" {{ old('ciudad') == 'Cartagena' ? 'selected' : '' }}>Cartagena</option>
                        <option value="Cúcuta" {{ old('ciudad') == 'Cúcuta' ? 'selected' : '' }}>Cúcuta</option>
                        <option value="Bucaramanga" {{ old('ciudad') == 'Bucaramanga' ? 'selected' : '' }}>Bucaramanga</option>
                        <option value="Pereira" {{ old('ciudad') == 'Pereira' ? 'selected' : '' }}>Pereira</option>
                        <option value="Santa Marta" {{ old('ciudad') == 'Santa Marta' ? 'selected' : '' }}>Santa Marta</option>
                        <option value="Ibagué" {{ old('ciudad') == 'Ibagué' ? 'selected' : '' }}>Ibagué</option>
                        <option value="Manizales" {{ old('ciudad') == 'Manizales' ? 'selected' : '' }}>Manizales</option>
                        <option value="Pasto" {{ old('ciudad') == 'Pasto' ? 'selected' : '' }}>Pasto</option>
                        <option value="Villavicencio" {{ old('ciudad') == 'Villavicencio' ? 'selected' : '' }}>Villavicencio</option>
                        <option value="Montería" {{ old('ciudad') == 'Montería' ? 'selected' : '' }}>Montería</option>
                        <option value="Neiva" {{ old('ciudad') == 'Neiva' ? 'selected' : '' }}>Neiva</option>
                        <option value="Armenia" {{ old('ciudad') == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                        <option value="Popayán" {{ old('ciudad') == 'Popayán' ? 'selected' : '' }}>Popayán</option>
                        <option value="Sincelejo" {{ old('ciudad') == 'Sincelejo' ? 'selected' : '' }}>Sincelejo</option>
                        <option value="Valledupar" {{ old('ciudad') == 'Valledupar' ? 'selected' : '' }}>Valledupar</option>
                        <option value="Tunja" {{ old('ciudad') == 'Tunja' ? 'selected' : '' }}>Tunja</option>
                        <option value="Florencia" {{ old('ciudad') == 'Florencia' ? 'selected' : '' }}>Florencia</option>
                        <option value="Quibdó" {{ old('ciudad') == 'Quibdó' ? 'selected' : '' }}>Quibdó</option>
                        <option value="Riohacha" {{ old('ciudad') == 'Riohacha' ? 'selected' : '' }}>Riohacha</option>
                        <option value="San Andrés" {{ old('ciudad') == 'San Andrés' ? 'selected' : '' }}>San Andrés</option>
                        <option value="Mocoa" {{ old('ciudad') == 'Mocoa' ? 'selected' : '' }}>Mocoa</option>
                        <option value="San José del Guaviare" {{ old('ciudad') == 'San José del Guaviare' ? 'selected' : '' }}>San José del Guaviare</option>
                        <option value="Inírida" {{ old('ciudad') == 'Inírida' ? 'selected' : '' }}>Inírida</option>
                        <option value="Mitú" {{ old('ciudad') == 'Mitú' ? 'selected' : '' }}>Mitú</option>
                        <option value="Puerto Carreño" {{ old('ciudad') == 'Puerto Carreño' ? 'selected' : '' }}>Puerto Carreño</option>
                    </select>
                    @error('ciudad')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = ['numero_documento', 'nombre', 'direccion', 'telefono', 'email', 'ciudad'].map(id => document.getElementById(id));

    form.addEventListener('submit', function(event) {
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
});
</script>
@endpush
