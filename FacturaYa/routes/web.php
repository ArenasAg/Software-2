<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('loading');
})->name('loading');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

Route::get('/compras', [CompraController::class, 'index'])->name('compras.index')->middleware(['auth', 'verified', 'role:admin|cliente']);
Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categorias', CategoriaController::class)->except(['index', 'show']);
    Route::resource('clientes', ClienteController::class)->except(['index', 'show']);
    Route::resource('facturas', FacturaController::class)->except(['index', 'show']);
    Route::resource('impuestos', ImpuestoController::class)->except(['index', 'show']);
    Route::resource('informes', InformeController::class)->except(['index', 'show']);
    Route::resource('inventarios', InventarioController::class)->except(['index', 'show']);
    Route::resource('metodoPagos', MetodoPagoController::class)->except(['index', 'show']);
    Route::resource('libros', LibroController::class)->except(['index', 'show']);
});

Route::get('/categorias/export/{format}', [CategoriaController::class, 'export'])->name('categorias.export')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/categorias/search', [CategoriaController::class, 'search'])->name('categorias.search')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/categorias/filter', [CategoriaController::class, 'filter'])->name('categorias.filter')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/clientes/export/{format}', [ClienteController::class, 'export'])->name('clientes.export')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/clientes/search', [ClienteController::class, 'search'])->name('clientes.search')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/clientes/filter', [ClienteController::class, 'filter'])->name('clientes.filter')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/facturas/export/{format}', [FacturaController::class, 'export'])->name('facturas.export')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/facturas/search', [FacturaController::class, 'search'])->name('facturas.search')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/facturas/filter', [FacturaController::class, 'filter'])->name('facturas.filter')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/impuestos/export/{format}', [ImpuestoController::class, 'export'])->name('impuestos.export')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/impuestos/search', [ImpuestoController::class, 'search'])->name('impuestos.search')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/impuestos/filter', [ImpuestoController::class, 'filter'])->name('impuestos.filter')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/informes/export/{format}', [InformeController::class, 'export'])->name('informes.export')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/informes/search', [InformeController::class, 'search'])->name('informes.search')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/informes/filter', [InformeController::class, 'filter'])->name('informes.filter')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/inventarios/export/{format}', [InventarioController::class, 'export'])->name('inventarios.export')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/inventarios/search', [InventarioController::class, 'search'])->name('inventarios.search')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/inventarios/filter', [InventarioController::class, 'filter'])->name('inventarios.filter')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/metodo-pagos/export/{format}', [MetodoPagoController::class, 'export'])->name('metodoPagos.export')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/metodoPagos/search', [MetodoPagoController::class, 'search'])->name('metodoPagos.search')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/metodoPagos/filter', [MetodoPagoController::class, 'filter'])->name('metodoPagos.filter')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/libros/export/{format}', [LibroController::class, 'export'])->name('libros.export')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/libros/search', [LibroController::class, 'search'])->name('libros.search')->middleware(['auth', 'verified', 'role:admin|supervisor']);;
Route::get('/libros/filter', [LibroController::class, 'filter'])->name('libros.filter')->middleware(['auth', 'verified', 'role:admin|supervisor']);;

Route::middleware(['auth', 'verified', 'role:supervisor'])->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::get('/facturas/{factura}', [FacturaController::class, 'show'])->name('facturas.show');
    Route::get('/impuestos', [ImpuestoController::class, 'index'])->name('impuestos.index');
    Route::get('/impuestos/{impuesto}', [ImpuestoController::class, 'show'])->name('impuestos.show');
    Route::get('/informes', [InformeController::class, 'index'])->name('informes.index');
    Route::get('/informes/{informe}', [InformeController::class, 'show'])->name('informes.show');
    Route::get('/inventarios', [InventarioController::class, 'index'])->name('inventarios.index');
    Route::get('/inventarios/{inventario}', [InventarioController::class, 'show'])->name('inventarios.show');
    Route::get('/metodoPagos', [MetodoPagoController::class, 'index'])->name('metodoPagos.index');
    Route::get('/metodoPagos/{metodoPago}', [MetodoPagoController::class, 'show'])->name('metodoPagos.show');
    Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
    Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');
});
