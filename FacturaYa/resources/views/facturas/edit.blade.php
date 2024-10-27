@extends('layouts.layout')

@section('title', 'Editar Factura')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('facturas.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Facturas
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Editar Factura</li>
        </ol>
    </nav>

    <h2 class="page-title">Editar Factura</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información de la Factura</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('facturas.update', $factura->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="codigo" class="form-label required-field">Código</label>
                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" value="{{ $factura->codigo }}" required>
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="fecha" class="form-label required-field">Fecha</label>
                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ $factura->fecha }}" required>
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="subtotal" class="form-label required-field">Subtotal</label>
                    <input type="number" class="form-control @error('subtotal') is-invalid @enderror" id="subtotal" name="subtotal" value="{{ $factura->subtotal }}" required>
                    @error('subtotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="total_impuestos" class="form-label required-field">Total Impuestos</label>
                    <input type="number" class="form-control @error('total_impuestos') is-invalid @enderror" id="total_impuestos" name="total_impuestos" value="{{ $factura->total_impuestos }}" required>
                    @error('total_impuestos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="total" class="form-label required-field">Total</label>
                    <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ $factura->total }}" required>
                    @error('total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="estado" class="form-label required-field">Estado</label>
                    <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                        <option value="true" {{ $factura->estado == true ? 'selected' : '' }}>Activo</option>
                        <option value="false" {{ !$factura->estado == false ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="cliente_id" class="form-label required-field">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror" required>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $cliente->id == $factura->cliente_id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="metodo_pago_id" class="form-label required-field">Método de Pago</label>
                    <select name="metodo_pago_id" id="metodo_pago_id" class="form-control @error('metodo_pago_id') is-invalid @enderror" required>
                        @foreach($metodosPago as $metodoPago)
                            <option value="{{ $metodoPago->id }}" {{ $metodoPago->id == $factura->metodo_pago_id ? 'selected' : '' }}>{{ $metodoPago->nombre }}</option>
                        @endforeach
                    </select>
                    @error('metodo_pago_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('facturas.index') }}" class="btn btn-outline-secondary">
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
    const inputs = form.querySelectorAll('input, select');

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
