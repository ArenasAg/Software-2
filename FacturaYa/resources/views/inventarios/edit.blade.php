@extends('layouts.layout')

@section('title', 'Editar Inventario')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inventarios.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Inventarios
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Editar Inventario</li>
        </ol>
    </nav>

    <h2 class="page-title">Editar Inventario</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Inventario</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('inventarios.update', $inventario->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="fecha" class="form-label required-field">Fecha</label>
                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ $inventario->fecha }}" required>
                    @error('fecha')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tipo_movimiento" class="form-label required-field">Tipo de Movimiento</label>
                    <select name="tipo_movimiento" id="tipo_movimiento" class="form-control @error('tipo_movimiento') is-invalid @enderror" required>
                        <option value="entrada" {{ $inventario->tipo_movimiento == 'entrada' ? 'selected' : '' }}>Entrada</option>
                        <option value="salida" {{ $inventario->tipo_movimiento == 'salida' ? 'selected' : '' }}>Salida</option>
                    </select>
                    @error('tipo_movimiento')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="entrada" class="form-label required-field">Entrada</label>
                    <input type="number" class="form-control @error('entrada') is-invalid @enderror" id="entrada" name="entrada" value="{{ $inventario->entrada }}" required>
                    @error('entrada')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="salida" class="form-label required-field">Salida</label>
                    <input type="number" class="form-control @error('salida') is-invalid @enderror" id="salida" name="salida" value="{{ $inventario->salida }}" required>
                    @error('salida')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="producto_id" class="form-label required-field">Producto</label>
                    <select class="form-control @error('producto_id') is-invalid @enderror" id="producto_id" name="producto_id" required>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ $inventario->producto_id == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('inventarios.index') }}" class="btn btn-outline-secondary">
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
    const requiredFields = document.querySelectorAll('.required-field');

    form.addEventListener('submit', function(event) {
        let isValid = true;

        requiredFields.forEach(function(field) {
            const input = field.querySelector('input, select');
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

    requiredFields.forEach(function(field) {
        const input = field.querySelector('input, select');
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
});
</script>
@endpush
