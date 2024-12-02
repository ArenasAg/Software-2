<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\api\v1\AuthController;

Route::post('/v1/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/v1/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/v1/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias.index')->middleware(['role:administrador|supervisor']);
    Route::get('categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show')->middleware(['role:administrador|supervisor']);
    Route::post('categorias', [CategoriaController::class, 'store'])->name('categorias.store')->middleware(['role:administrador']);
    Route::put('categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update')->middleware(['role:administrador']);
    Route::delete('categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy')->middleware(['role:administrador']);

    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index')->middleware(['role:administrador|supervisor']);
    Route::get('clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show')->middleware(['role:administrador|supervisor']);
    Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store')->middleware(['role:administrador']);
    Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update')->middleware(['role:administrador']);
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy')->middleware(['role:administrador']);

    Route::get('facturas', [FacturaController::class, 'index'])->name('facturas.index')->middleware(['role:administrador|supervisor|cliente']);
    Route::get('facturas/{factura}', [FacturaController::class, 'show'])->name('facturas.show')->middleware(['role:administrador|supervisor|cliente']);
    Route::post('facturas', [FacturaController::class, 'store'])->name('facturas.store')->middleware(['role:administrador']);
    Route::put('facturas/{factura}', [FacturaController::class, 'update'])->name('facturas.update')->middleware(['role:administrador']);
    Route::delete('facturas/{factura}', [FacturaController::class, 'destroy'])->name('facturas.destroy')->middleware(['role:administrador']);

    Route::get('impuestos', [ImpuestoController::class, 'index'])->name('impuestos.index')->middleware(['role:administrador|supervisor']);
    Route::get('impuestos/{impuesto}', [ImpuestoController::class, 'show'])->name('impuestos.show')->middleware(['role:administrador|supervisor']);
    Route::post('impuestos', [ImpuestoController::class, 'store'])->name('impuestos.store')->middleware(['role:administrador']);
    Route::put('impuestos/{impuesto}', [ImpuestoController::class, 'update'])->name('impuestos.update')->middleware(['role:administrador']);
    Route::delete('impuestos/{impuesto}', [ImpuestoController::class, 'destroy'])->name('impuestos.destroy')->middleware(['role:administrador']);

    Route::get('informes', [InformeController::class, 'index'])->name('informes.index')->middleware(['role:administrador|supervisor']);
    Route::get('informes/{informe}', [InformeController::class, 'show'])->name('informes.show')->middleware(['role:administrador|supervisor']);
    Route::post('informes', [InformeController::class, 'store'])->name('informes.store')->middleware(['role:administrador']);
    Route::put('informes/{informe}', [InformeController::class, 'update'])->name('informes.update')->middleware(['role:administrador']);
    Route::delete('informes/{informe}', [InformeController::class, 'destroy'])->name('informes.destroy')->middleware(['role:administrador']);
    
    Route::get('inventarios', [InventarioController::class, 'index'])->name('inventarios.index')->middleware(['role:administrador|supervisor']);
    Route::get('inventarios/{inventario}', [InventarioController::class, 'show'])->name('inventarios.show')->middleware(['role:administrador|supervisor']);
    Route::post('inventarios', [InventarioController::class, 'store'])->name('inventarios.store')->middleware(['role:administrador']);
    Route::put('inventarios/{inventario}', [InventarioController::class, 'update'])->name('inventarios.update')->middleware(['role:administrador']);
    Route::delete('inventarios/{inventario}', [InventarioController::class, 'destroy'])->name('inventarios.destroy')->middleware(['role:administrador']);

    Route::get('metodoPagos', [MetodoPagoController::class, 'index'])->name('metodoPagos.index')->middleware(['role:administrador|supervisor']);
    Route::get('metodoPagos/{metodoPago}', [MetodoPagoController::class, 'show'])->name('metodoPagos.show')->middleware(['role:administrador|supervisor']);
    Route::post('metodoPagos', [MetodoPagoController::class, 'store'])->name('metodoPagos.store')->middleware(['role:administrador']);
    Route::put('metodoPagos/{metodoPago}', [MetodoPagoController::class, 'update'])->name('metodoPagos.update')->middleware(['role:administrador']);
    Route::delete('metodoPagos/{metodoPago}', [MetodoPagoController::class, 'destroy'])->name('metodoPagos.destroy')->middleware(['role:administrador']);

    Route::get('libros', [LibroController::class, 'index'])->name('libros.index')->middleware(['role:administrador|supervisor']);
    Route::get('libros/{libro}', [LibroController::class, 'show'])->name('libros.show')->middleware(['role:administrador|supervisor']);
    Route::post('libros', [LibroController::class, 'store'])->name('libros.store')->middleware(['role:administrador']);
    Route::put('libros/{libro}', [LibroController::class, 'update'])->name('libros.update')->middleware(['role:administrador']);
    Route::delete('libros/{libro}', [LibroController::class, 'destroy'])->name('libros.destroy')->middleware(['role:administrador']);

    Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
    Route::post('/compras', [CompraController::class, 'comprar'])->name('compras')->middleware(['role:administrador|cliente']);
    Route::get('/payment/return', [CompraController::class, 'paymentReturn'])->name('payment.return');

    Route::get('/categorias/export/{format}', [CategoriaController::class, 'export'])->name('categorias.export')->middleware(['role:administrador|supervisor']);
    Route::get('/categorias/search', [CategoriaController::class, 'search'])->name('categorias.search')->middleware(['role:administrador|supervisor']);
    Route::get('/categorias/filter', [CategoriaController::class, 'filter'])->name('categorias.filter')->middleware(['role:administrador|supervisor']);
    Route::get('/clientes/export/{format}', [ClienteController::class, 'export'])->name('clientes.export')->middleware(['role:administrador|supervisor']);
    Route::get('/clientes/search', [ClienteController::class, 'search'])->name('clientes.search')->middleware(['role:administrador|supervisor']);
    Route::get('/clientes/filter', [ClienteController::class, 'filter'])->name('clientes.filter')->middleware(['role:administrador|supervisor']);
    Route::get('/facturas/export/{format}', [FacturaController::class, 'export'])->name('facturas.export')->middleware(['role:administrador|supervisor']);
    Route::get('/facturas/search', [FacturaController::class, 'search'])->name('facturas.search')->middleware(['role:administrador|supervisor']);
    Route::get('/facturas/filter', [FacturaController::class, 'filter'])->name('facturas.filter')->middleware(['role:administrador|supervisor']);
    Route::get('/impuestos/export/{format}', [ImpuestoController::class, 'export'])->name('impuestos.export')->middleware(['role:administrador|supervisor']);
    Route::get('/impuestos/search', [ImpuestoController::class, 'search'])->name('impuestos.search')->middleware(['role:administrador|supervisor']);
    Route::get('/impuestos/filter', [ImpuestoController::class, 'filter'])->name('impuestos.filter')->middleware(['role:administrador|supervisor']);
    Route::get('/informes/export/{format}', [InformeController::class, 'export'])->name('informes.export')->middleware(['role:administrador|supervisor']);
    Route::get('/informes/search', [InformeController::class, 'search'])->name('informes.search')->middleware(['role:administrador|supervisor']);
    Route::get('/informes/filter', [InformeController::class, 'filter'])->name('informes.filter')->middleware(['role:administrador|supervisor']);
    Route::get('/inventarios/export/{format}', [InventarioController::class, 'export'])->name('inventarios.export')->middleware(['role:administrador|supervisor']);
    Route::get('/inventarios/search', [InventarioController::class, 'search'])->name('inventarios.search')->middleware(['role:administrador|supervisor']);
    Route::get('/inventarios/filter', [InventarioController::class, 'filter'])->name('inventarios.filter')->middleware(['role:administrador|supervisor']);
    Route::get('/metodo-pagos/export/{format}', [MetodoPagoController::class, 'export'])->name('metodoPagos.export')->middleware(['role:administrador|supervisor']);
    Route::get('/metodoPagos/search', [MetodoPagoController::class, 'search'])->name('metodoPagos.search')->middleware(['role:administrador|supervisor']);
    Route::get('/metodoPagos/filter', [MetodoPagoController::class, 'filter'])->name('metodoPagos.filter')->middleware(['role:administrador|supervisor']);
    Route::get('/libros/export/{format}', [LibroController::class, 'export'])->name('libros.export')->middleware(['role:administrador|supervisor']);
    Route::get('/libros/search', [LibroController::class, 'search'])->name('libros.search')->middleware(['role:administrador|supervisor']);
    Route::get('/libros/filter', [LibroController::class, 'filter'])->name('libros.filter')->middleware(['role:administrador|supervisor']);
});