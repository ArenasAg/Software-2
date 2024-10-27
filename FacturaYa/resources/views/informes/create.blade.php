@extends('layouts.layout')

@section('title', 'Crear Informe')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('informes.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Informes
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Crear Informe</li>
        </ol>
    </nav>

    <h2 class="page-title">Crear Nuevo Informe</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Informe</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('informes.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="fecha" class="form-label required-field">Fecha</label>
                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" required>
                    @error('fecha')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tipo_informe" class="form-label required-field">Tipo de Informe</label>
                    <select name="tipo_informe" id="tipo_informe" class="form-control @error('tipo_informe') is-invalid @enderror" required>
                        <option value="1">Informe de Ventas</option>
                        <option value="2">Informe de Compras</option>
                        <option value="3">Informe de Inventario</option>
                    </select>
                    @error('tipo_informe')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="datos_json" class="form-label required-field">Datos JSON</label>
                    <textarea class="form-control @error('datos_json') is-invalid @enderror" id="datos_json" name="datos_json" rows="4" required></textarea>
                    @error('datos_json')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('informes.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar Informe
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
    const fechaInput = document.getElementById('fecha');
    const tipoInformeSelect = document.getElementById('tipo_informe');
    const datosJsonTextarea = document.getElementById('datos_json');

    form.addEventListener('submit', function(event) {
        let isValid = true;

        if (!fechaInput.value.trim()) {
            isValid = false;
            fechaInput.classList.add('is-invalid');
        } else {
            fechaInput.classList.remove('is-invalid');
        }

        if (!tipoInformeSelect.value.trim()) {
            isValid = false;
            tipoInformeSelect.classList.add('is-invalid');
        } else {
            tipoInformeSelect.classList.remove('is-invalid');
        }

        if (!datosJsonTextarea.value.trim()) {
            isValid = false;
            datosJsonTextarea.classList.add('is-invalid');
        } else {
            datosJsonTextarea.classList.remove('is-invalid');
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    fechaInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });

    tipoInformeSelect.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });

    datosJsonTextarea.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });
});
</script>
@endpush
