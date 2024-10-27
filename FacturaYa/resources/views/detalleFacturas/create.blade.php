@extends('layouts.layout')

@section('title', 'Crear Detalle Factura')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('detalleFacturas.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Detalle Facturas
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Crear Detalle Factura</li>
        </ol>
    </nav>

    <h2 class="page-title">Crear Nuevo Detalle Factura</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Detalle Factura</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('detalleFacturas.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="cantidad" class="form-label required-field">Cantidad</label>
                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad" required>
                    @error('cantidad')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="valor_total" class="form-label required-field">Valor Total</label>
                    <input type="number" class="form-control @error('valor_total') is-invalid @enderror" id="valor_total" name="valor_total" placeholder="Ingrese el valor total" required>
                    @error('valor_total')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="descuento" class="form-label required-field">Descuento</label>
                    <input type="number" class="form-control @error('descuento') is-invalid @enderror" id="descuento" name="descuento" placeholder="Ingrese el descuento" required>
                    @error('descuento')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="producto_id" class="form-label required-field">Producto</label>
                    <select name="producto_id" id="producto_id" class="form-control @error('producto_id') is-invalid @enderror">
                        @if($productos->isEmpty())
                            <option value="">No hay productos disponibles</option>
                        @else
                            <option value="">Seleccione un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        @endif
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
                        @if($facturas->isEmpty())
                            <option value="">No hay facturas disponibles</option>
                        @else
                            <option value="">Seleccione una factura</option>
                            @foreach($facturas as $factura)
                                <option value="{{ $factura->id }}">{{ $factura->codigo }}</option>
                            @endforeach
                        @endif
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
                        <i class="fas fa-save me-1"></i>Guardar Detalle Factura
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
    const cantidadInput = document.getElementById('cantidad');
    const valorTotalInput = document.getElementById('valor_total');
    const descuentoInput = document.getElementById('descuento');

    form.addEventListener('submit', function(event) {
        let isValid = true;

        if (!cantidadInput.value.trim()) {
            isValid = false;
            cantidadInput.classList.add('is-invalid');
        } else {
            cantidadInput.classList.remove('is-invalid');
        }

        if (!valorTotalInput.value.trim()) {
            isValid = false;
            valorTotalInput.classList.add('is-invalid');
        } else {
            valorTotalInput.classList.remove('is-invalid');
        }

        if (!descuentoInput.value.trim()) {
            isValid = false;
            descuentoInput.classList.add('is-invalid');
        } else {
            descuentoInput.classList.remove('is-invalid');
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    cantidadInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });

    valorTotalInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });

    descuentoInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });
});
</script>
@endpush
