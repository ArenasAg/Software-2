@extends('layouts.layout')

@section('title', 'Editar Cliente')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('clientes.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Clientes
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Editar Cliente</li>
        </ol>
    </nav>

    <h2 class="page-title">Editar Cliente</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Cliente</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="numero_documento" class="form-label required-field">Numero de documento</label>
                    <input type="text" name="numero_documento" class="form-control @error('numero_documento') is-invalid @enderror" id="numero_documento" value="{{ $cliente->numero_documento }}" required>
                    @error('numero_documento')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="nombre" class="form-label required-field">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" value="{{ $cliente->nombre }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="direccion" class="form-label required-field">Direccion</label>
                    <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" id="direccion" value="{{ $cliente->direccion }}" required>
                    @error('direccion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="telefono" class="form-label required-field">Telefono</label>
                    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" id="telefono" value="{{ $cliente->telefono }}" required>
                    @error('telefono')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label required-field">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $cliente->email }}" required>
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
                        <option value="Bogotá" {{ $cliente->ciudad == 'Bogotá' ? 'selected' : '' }}>Bogotá</option>
                        <option value="Medellín" {{ $cliente->ciudad == 'Medellín' ? 'selected' : '' }}>Medellín</option>
                        <option value="Cali" {{ $cliente->ciudad == 'Cali' ? 'selected' : '' }}>Cali</option>
                        <option value="Barranquilla" {{ $cliente->ciudad == 'Barranquilla' ? 'selected' : '' }}>Barranquilla</option>
                        <option value="Cartagena" {{ $cliente->ciudad == 'Cartagena' ? 'selected' : '' }}>Cartagena</option>
                        <option value="Cúcuta" {{ $cliente->ciudad == 'Cúcuta' ? 'selected' : '' }}>Cúcuta</option>
                        <option value="Bucaramanga" {{ $cliente->ciudad == 'Bucaramanga' ? 'selected' : '' }}>Bucaramanga</option>
                        <option value="Pereira" {{ $cliente->ciudad == 'Pereira' ? 'selected' : '' }}>Pereira</option>
                        <option value="Santa Marta" {{ $cliente->ciudad == 'Santa Marta' ? 'selected' : '' }}>Santa Marta</option>
                        <option value="Ibagué" {{ $cliente->ciudad == 'Ibagué' ? 'selected' : '' }}>Ibagué</option>
                        <option value="Manizales" {{ $cliente->ciudad == 'Manizales' ? 'selected' : '' }}>Manizales</option>
                        <option value="Pasto" {{ $cliente->ciudad == 'Pasto' ? 'selected' : '' }}>Pasto</option>
                        <option value="Villavicencio" {{ $cliente->ciudad == 'Villavicencio' ? 'selected' : '' }}>Villavicencio</option>
                        <option value="Montería" {{ $cliente->ciudad == 'Montería' ? 'selected' : '' }}>Montería</option>
                        <option value="Neiva" {{ $cliente->ciudad == 'Neiva' ? 'selected' : '' }}>Neiva</option>
                        <option value="Armenia" {{ $cliente->ciudad == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                        <option value="Popayán" {{ $cliente->ciudad == 'Popayán' ? 'selected' : '' }}>Popayán</option>
                        <option value="Sincelejo" {{ $cliente->ciudad == 'Sincelejo' ? 'selected' : '' }}>Sincelejo</option>
                        <option value="Valledupar" {{ $cliente->ciudad == 'Valledupar' ? 'selected' : '' }}>Valledupar</option>
                        <option value="Tunja" {{ $cliente->ciudad == 'Tunja' ? 'selected' : '' }}>Tunja</option>
                        <option value="Florencia" {{ $cliente->ciudad == 'Florencia' ? 'selected' : '' }}>Florencia</option>
                        <option value="Quibdó" {{ $cliente->ciudad == 'Quibdó' ? 'selected' : '' }}>Quibdó</option>
                        <option value="Riohacha" {{ $cliente->ciudad == 'Riohacha' ? 'selected' : '' }}>Riohacha</option>
                        <option value="San Andrés" {{ $cliente->ciudad == 'San Andrés' ? 'selected' : '' }}>San Andrés</option>
                        <option value="Mocoa" {{ $cliente->ciudad == 'Mocoa' ? 'selected' : '' }}>Mocoa</option>
                        <option value="San José del Guaviare" {{ $cliente->ciudad == 'San José del Guaviare' ? 'selected' : '' }}>San José del Guaviare</option>
                        <option value="Inírida" {{ $cliente->ciudad == 'Inírida' ? 'selected' : '' }}>Inírida</option>
                        <option value="Mitú" {{ $cliente->ciudad == 'Mitú' ? 'selected' : '' }}>Mitú</option>
                        <option value="Puerto Carreño" {{ $cliente->ciudad == 'Puerto Carreño' ? 'selected' : '' }}>Puerto Carreño</option>
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
                        <i class="fas fa-save me-1"></i>Actualizar
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
    const inputs = form.querySelectorAll('input[required]');

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
