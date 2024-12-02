<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('loading');
})->name('loading');


