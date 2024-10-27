@extends('layouts.layout')

@section('title', 'Crear Factura')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('facturas.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Facturas
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Crear Factura</li>
        </ol>
    </nav>

    <h2 class="page-title">Crear Nueva Factura</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información de la Factura</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('facturas.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="codigo" class="form-label required-field">Codigo</label>
                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" required value="{{ old('codigo') }}" placeholder="Ingrese el código">
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="fecha" class="form-label required-field">Fecha</label>
                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" required value="{{ old('fecha') }}" placeholder="Seleccione la fecha">
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="subtotal" class="form-label required-field">Subtotal</label>
                    <input type="number" class="form-control @error('subtotal') is-invalid @enderror" id="subtotal" name="subtotal" required value="{{ old('subtotal') }}" placeholder="Ingrese el subtotal">
                    @error('subtotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="total_impuestos" class="form-label required-field">Total Impuestos</label>
                    <input type="number" class="form-control @error('total_impuestos') is-invalid @enderror" id="total_impuestos" name="total_impuestos" required value="{{ old('total_impuestos') }}" placeholder="Ingrese el total de impuestos">
                    @error('total_impuestos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="total" class="form-label required-field">Total</label>
                    <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" required value="{{ old('total') }}" placeholder="Ingrese el total">
                    @error('total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="estado" class="form-label required-field">Estado</label>
                    <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                        <option value="">Seleccione el estado</option>
                        <option value="true" {{ old('estado') == 'true' ? 'selected' : '' }}>Activo</option>
                        <option value="false" {{ old('estado') == 'false' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="cliente_id" class="form-label required-field">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror" required>
                        @if($clientes->isEmpty())
                            <option value="">No hay clientes disponibles</option>
                        @else
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('cliente_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="metodo_pago_id" class="form-label required-field">Metodo de Pago</label>
                    <select name="metodo_pago_id" id="metodo_pago_id" class="form-control @error('metodo_pago_id') is-invalid @enderror" required>
                        @if($metodoPagos->isEmpty())
                            <option value="">No hay metodos de pago disponibles</option>
                        @else
                            <option value="">Seleccione un metodo de pago</option>
                            @foreach($metodoPagos as $metodoPago)
                                <option value="{{ $metodoPago->id }}">{{ $metodoPago->nombre }}</option>
                            @endforeach
                        @endif
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
                        <i class="fas fa-save me-1"></i>Guardar Factura
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
