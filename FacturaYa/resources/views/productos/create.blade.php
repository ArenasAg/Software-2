@extends('layouts.layout')

@section('title', 'Crear Producto')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('productos.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Productos
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Crear Producto</li>
        </ol>
    </nav>

    <h2 class="page-title">Crear Nuevo Producto</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Producto</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="codigo" class="form-label required-field">Código</label>
                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" required value="{{ old('codigo') }}" placeholder="Ingrese el código del producto">
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="nombre" class="form-label required-field">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required value="{{ old('nombre') }}" placeholder="Ingrese la descripción del producto">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="imagen" class="form-label required-field">Imagen</label>
                    <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" required value="{{ old('imagen') }}" placeholder="Ingrese la imagen del producto" accept="image/*">
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="precio" class="form-label required-field">Precio de Venta</label>
                    <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" required value="{{ old('precio') }}" placeholder="Ingrese el precio de venta">
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="medida" class="form-label required-field">Medida</label>
                    <input type="text" class="form-control @error('medida') is-invalid @enderror" id="medida" name="medida" required value="{{ old('medida') }}" placeholder="Ingrese la medida del producto">
                    @error('medida')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="categoria_id" class="form-label required-field">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="impuesto_id" class="form-label required-field">Impuesto</label>
                    <select name="impuesto_id" id="impuesto_id" class="form-control @error('impuesto_id') is-invalid @enderror">
                        <option value="">Seleccione un impuesto</option>
                        @foreach ($impuestos as $impuesto)
                            <option value="{{ $impuesto->id }}" {{ old('impuesto_id') == $impuesto->id ? 'selected' : '' }}>{{ $impuesto->nombre }}</option>
                        @endforeach
                    </select>
                    @error('impuesto_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar Producto
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
    const inputs = ['codigo', 'descripcion', 'precio', 'medida', 'categoria_id', 'impuesto_id'].map(id => document.getElementById(id));

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
