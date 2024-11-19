<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use Illuminate\Support\Facades\Route;

Route::apiResource('login', AuthenticatedSessionController::class);
Route::apiResource('register', RegisteredUserController::class);

Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function () {
    Route::apiResource('forgot-password', PasswordResetLinkController::class);
    Route::apiResource('reset-password', NewPasswordController::class);
    Route::apiResource('confirm-password', ConfirmablePasswordController::class);
    Route::apiResource('email/verify', EmailVerificationNotificationController::class);
    Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke']);
    Route::apiResource('email/verify', EmailVerificationPromptController::class);
    Route::apiResource('api_categorias', CategoriaController::class);
    Route::apiResource('api_clientes', ClienteController::class);
    Route::apiResource('api_facturas', FacturaController::class);
    Route::apiResource('api_impuestos', ImpuestoController::class);
    Route::apiResource('api_informes', InformeController::class);
    Route::apiResource('api_inventarios', InventarioController::class);
    Route::apiResource('api_metodos_pago', MetodoPagoController::class);
    Route::apiResource('api_libros', LibroController::class);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//Poner nombres a todas las rutas
//Route::get('/hola/locos' , [CabinController::class ,'index'])->name("hola.locos");



