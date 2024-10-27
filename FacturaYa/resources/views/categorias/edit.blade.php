@extends('layouts.layout')

@section('title', 'Editar Categoría')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('categorias.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Categorías
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Editar Categoría</li>
        </ol>
    </nav>

    <h2 class="page-title">Editar Categoría</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información de la Categoría</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nombre" class="form-label required-field">
                        Descripción de la Categoría
                    </label>
                    <input
                        type="text"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        name="nombre"
                        placeholder="Ingrese la descripción de la categoría"
                        required
                        value="{{ $categoria->nombre }}"
                    >
                    @error('nombre')
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
