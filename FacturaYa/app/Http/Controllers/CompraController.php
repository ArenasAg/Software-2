<?php
// FILE: app/Http/Controllers/CompraController.php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\MetodoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CompraController extends Controller
{
    public function index(Request $request)
    {
        $libros = Libro::paginate(12);
        $data = [];

        foreach ($libros as $libro) {
            if ($libro) {
                $data[] = [
                    'nombre' => $libro->nombre,
                    'descripcion' => 'El libro ' . $libro->nombre . ' tiene una medida de ' . $libro->medida . ' y se encuentra en la categoría ' . $libro->categoria->nombre,
                    'precio' => $libro->precio,
                ];
            }
        }

        return response()->json(['data' => $data], 200);
    }

    public function comprar(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.libro_id' => 'required|exists:libros,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'metodo_pago_id' => 'required|exists:metodo_pagos,id',
            'nombre' => 'required|string',
            'numero_tarjeta' => 'required|string',
            'expiracion' => 'required|date_format:m/y',
            'cvv' => 'required|string',
        ]);

        $total = 0;
        $productos = $request->input('productos');

        foreach ($productos as $producto) {
            $libro = Libro::findOrFail($producto['libro_id']);
            $total += ($libro->precio * $producto['cantidad']) * (1 + $libro->impuesto / 100);
        }

        // Obtener el identificador del método de pago
        $metodoPago = MetodoPago::findOrFail($request->metodo_pago_id);

        // Configurar Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Crear el PaymentIntent en Stripe
            $paymentIntent = PaymentIntent::create([
                'amount' => $total * 100, // Stripe maneja los montos en centavos
                'currency' => 'cop', // Moneda colombiana
                'payment_method' => $metodoPago->identificador, // Proporcionar el payment_method_id
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('payment.return'), // URL de retorno
            ]);

            if ($paymentIntent->status == 'succeeded') {
                // Crear la factura solo si el pago es exitoso
                $factura = Factura::create([
                    'codigo' => 'FAC' . time(),
                    'cliente_id' => Auth::user()->id,
                    'metodo_pago_id' => $request->metodo_pago_id, // Usar el metodo_pago_id de la solicitud
                    'subtotal' => $total,
                    'total_impuestos' => $total * ($libro->impuesto / 100),
                    'total' => $total,
                    'estado' => true,
                ]);

                // Crear los detalles de la factura
                foreach ($productos as $producto) {
                    $libro = Libro::findOrFail($producto['libro_id']);
                    DetalleFactura::create([
                        'factura_id' => $factura->id,
                        'libro_id' => $libro->id,
                        'cantidad' => $producto['cantidad'],
                        'precio_unitario' => $libro->precio,
                        'valor_total' => $libro->precio * $producto['cantidad'],
                        'descuento' => 0, // Puedes ajustar esto según sea necesario
                    ]);
                }

                return response()->json(['message' => 'Compra realizada con éxito', 'factura' => $factura], 200);
            } else {
                return response()->json(['error' => 'El pago no se pudo completar.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el pago: ' . $e->getMessage()], 500);
        }
    }

    public function paymentReturn(Request $request)
    {
        // Manejar la lógica después de que el cliente sea redirigido a la URL de retorno
        return response()->json(['message' => 'Pago completado.'], 200);
    }
}