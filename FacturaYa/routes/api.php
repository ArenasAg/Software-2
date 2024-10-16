<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('categorias',CategoriaController::class);
Route::apiResource('clientes',ClienteController::class);
Route::apiResource('detalle_facturas',DetalleFacturaController::class);
Route::apiResource('facturas',FacturaController::class);
Route::apiResource('impuestos',ImpuestoController::class);
Route::apiResource('informes',InformeController::class);
Route::apiResource('invetarios',InventarioController::class);
Route::apiResource('metodos_pago',MetodoPagoController::class);
Route::apiResource('productos',ProductoController::class);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//Poner nombres a todas las rutas
//Route::get('/hola/locos' , [CabinController::class ,'index'])->name("hola.locos");



