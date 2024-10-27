@extends('layouts.layout')

@section('title', 'Crear Impuesto')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('impuestos.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Impuestos
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Crear Impuesto</li>
        </ol>
    </nav>

    <h2 class="page-title">Crear Nuevo Impuesto</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Impuesto</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('impuestos.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="form-label required-field">
                        Nombre del Impuesto
                    </label>
                    <input
                        type="text"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        name="nombre"
                        placeholder="Ingrese el nombre del impuesto"
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
                    <label for="porcentaje" class="form-label required-field">
                        Porcentaje del Impuesto
                    </label>
                    <input
                        type="number"
                        class="form-control @error('porcentaje') is-invalid @enderror"
                        id="porcentaje"
                        name="porcentaje"
                        placeholder="Ingrese el porcentaje del impuesto"
                        required
                        value="{{ old('porcentaje') }}"
                    >
                    @error('porcentaje')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('impuestos.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar Impuesto
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
    const nombreInput = document.getElementById('nombre');
    const porcentajeInput = document.getElementById('porcentaje');

    form.addEventListener('submit', function(event) {
        let isValid = true;

        if (!nombreInput.value.trim()) {
            isValid = false;
            nombreInput.classList.add('is-invalid');
        } else {
            nombreInput.classList.remove('is-invalid');
        }

        if (!porcentajeInput.value.trim()) {
            isValid = false;
            porcentajeInput.classList.add('is-invalid');
        } else {
            porcentajeInput.classList.remove('is-invalid');
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    nombreInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });

    porcentajeInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });
});
</script>
@endpush
