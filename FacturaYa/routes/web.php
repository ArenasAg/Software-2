<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::get('/detalleFacturas', [DetalleFacturaController::class, 'index'])->name('detalleFacturas.index');
Route::get('/detalleFacturas/create', [DetalleFacturaController::class, 'create'])->name('detalleFacturas.create');
Route::post('/detalleFacturas', [DetalleFacturaController::class, 'store'])->name('detalleFacturas.store');
Route::get('/detalleFacturas/{id}/edit', [DetalleFacturaController::class, 'edit'])->name('detalleFacturas.edit');
Route::put('/detalleFacturas/{id}', [DetalleFacturaController::class, 'update'])->name('detalleFacturas.update');
Route::delete('/detalleFacturas/{id}', [DetalleFacturaController::class, 'destroy'])->name('detalleFacturas.destroy');

Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');
Route::get('/facturas/create', [FacturaController::class, 'create'])->name('facturas.create');
Route::post('/facturas', [FacturaController::class, 'store'])->name('facturas.store');
Route::get('/facturas/{id}/edit', [FacturaController::class, 'edit'])->name('facturas.edit');
Route::put('/facturas/{id}', [FacturaController::class, 'update'])->name('facturas.update');
Route::delete('/facturas/{id}', [FacturaController::class, 'destroy'])->name('facturas.destroy');

Route::get('/impuestos', [ImpuestoController::class, 'index'])->name('impuestos.index');
Route::get('/impuestos/create', [ImpuestoController::class, 'create'])->name('impuestos.create');
Route::post('/impuestos', [ImpuestoController::class, 'store'])->name('impuestos.store');
Route::get('/impuestos/{id}/edit', [ImpuestoController::class, 'edit'])->name('impuestos.edit');
Route::put('/impuestos/{id}', [ImpuestoController::class, 'update'])->name('impuestos.update');
Route::delete('/impuestos/{id}', [ImpuestoController::class, 'destroy'])->name('impuestos.destroy');

Route::get('/informes', [InformeController::class, 'index'])->name('informes.index');
Route::get('/informes/create', [InformeController::class, 'create'])->name('informes.create');
Route::post('/informes', [InformeController::class, 'store'])->name('informes.store');
Route::get('/informes/{id}/edit', [InformeController::class, 'edit'])->name('informes.edit');
Route::put('/informes/{id}', [InformeController::class, 'update'])->name('informes.update');
Route::delete('/informes/{id}', [InformeController::class, 'destroy'])->name('informes.destroy');

Route::get('/inventarios', [InventarioController::class, 'index'])->name('inventarios.index');
Route::get('/inventarios/create', [InventarioController::class, 'create'])->name('inventarios.create');
Route::post('/inventarios', [InventarioController::class, 'store'])->name('inventarios.store');
Route::get('/inventarios/{id}/edit', [InventarioController::class, 'edit'])->name('inventarios.edit');
Route::put('/inventarios/{id}', [InventarioController::class, 'update'])->name('inventarios.update');
Route::delete('/inventarios/{id}', [InventarioController::class, 'destroy'])->name('inventarios.destroy');

Route::get('/metodoPagos', [MetodoPagoController::class, 'index'])->name('metodoPagos.index');
Route::get('/metodoPagos/create', [MetodoPagoController::class, 'create'])->name('metodoPagos.create');
Route::post('/metodoPagos', [MetodoPagoController::class, 'store'])->name('metodoPagos.store');
Route::get('/metodoPagos/{id}/edit', [MetodoPagoController::class, 'edit'])->name('metodoPagos.edit');
Route::put('/metodoPagos/{id}', [MetodoPagoController::class, 'update'])->name('metodoPagos.update');
Route::delete('/metodoPagos/{id}', [MetodoPagoController::class, 'destroy'])->name('metodoPagos.destroy');

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
