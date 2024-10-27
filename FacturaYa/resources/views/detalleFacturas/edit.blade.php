@extends('layouts.layout')

@section('title', 'Editar Detalle Factura')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('detalleFacturas.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Detalles de Facturas
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Editar Detalle Factura</li>
        </ol>
    </nav>

    <h2 class="page-title">Editar Detalle Factura</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Detalle</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('detalleFacturas.update', $detalleFactura->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="cantidad" class="form-label required-field">Cantidad</label>
                    <input type="text" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" value="{{ $detalleFactura->cantidad }}" required>
                    @error('cantidad')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="valor_total" class="form-label required-field">Valor Total</label>
                    <input type="text" name="valor_total" class="form-control @error('valor_total') is-invalid @enderror" id="valor_total" value="{{ $detalleFactura->valor_total }}" required>
                    @error('valor_total')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="descuento" class="form-label required-field">Descuento</label>
                    <input type="text" name="descuento" class="form-control @error('descuento') is-invalid @enderror" id="descuento" value="{{ $detalleFactura->descuento }}" required>
                    @error('descuento')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="producto_id" class="form-label required-field">Producto</label>
                    <select name="producto_id" id="producto_id" class="form-control @error('producto_id') is-invalid @enderror">
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ $producto->id == $detalleFactura->producto_id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="factura_id" class="form-label required-field">Factura</label>
                    <select name="factura_id" id="factura_id" class="form-control @error('factura_id') is-invalid @enderror">
                        @foreach($facturas as $factura)
                            <option value="{{ $factura->id }}" {{ $factura->id == $detalleFactura->factura_id ? 'selected' : '' }}>{{ $factura->codigo }}</option>
                        @endforeach
                    </select>
                    @error('factura_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('detalleFacturas.index') }}" class="btn btn-outline-secondary">
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
    const inputs = document.querySelectorAll('input, select');

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
