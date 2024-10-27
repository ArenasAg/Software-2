@extends('layouts.layout')

@section('title', 'Crear Categoría')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('categorias.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Categorías
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Crear Categoría</li>
        </ol>
    </nav>

    <h2 class="page-title">Crear Nueva Categoría</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información de la Categoría</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="form-label required-field">
                        Nombre de la Categoría
                    </label>
                    <input
                        type="text"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        name="nombre"
                        placeholder="Ingrese el nombre de la categoría"
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
                    <label for="descripcion" class="form-label required-field">
                        Descripcion de la Categoría
                    </label>
                    <input
                        type="text"
                        class="form-control @error('descripcion') is-invalid @enderror"
                        id="descripcion"
                        name="descripcion"
                        placeholder="Ingrese el descripcion de la categoría"
                        required
                        value="{{ old('descripcion') }}"
                    >
                    @error('descripcion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar Categoría
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
    const descripcionInput = document.getElementById('descripcion');

    form.addEventListener('submit', function(event) {
        let isValid = true;

        if (!descripcionInput.value.trim()) {
            isValid = false;
            descripcionInput.classList.add('is-invalid');
        } else {
            descripcionInput.classList.remove('is-invalid');
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    descripcionInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });
});
</script>
@endpush
