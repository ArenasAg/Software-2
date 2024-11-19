<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index(Request $request)
    {
        $libros = Libro::paginate(12);
        $categorias = Categoria::all();
        if ($request->ajax()) {
            return response()->json([
                'libros' => $libros,
                'categorias' => $categorias,
            ]);
        }
        return view('compras.index', compact('libros', 'categorias'));
    }

    public function comprar(Request $request, Libro $libro)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1|max:' . $libro->stock,
        ]);

        // Crear la factura
        $factura = Factura::create([
            'codigo' => 'FAC' . time(),
            'cliente_id' => auth()->user()->id,
            'metodo_pago_id' => 0,
            'subtotal' => $libro->precio * $request->cantidad,
            'total_impuestos' => ($libro->precio * $request->cantidad) * ($libro->impuesto / 100),
            'total' => ($libro->precio * $request->cantidad) * (1 + $libro->impuesto / 100),
            'estado' => false,
        ]);

        // Crear el detalle de la factura
        DetalleFactura::create([
            'factura_id' => $factura->id,
            'libro_id' => $libro->id,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $libro->precio,
            'descuento' => 0,
            'valor_total' => $libro->precio * $request->cantidad,
        ]);

        // Actualizar el stock del libro
        $libro->stock -= $request->cantidad;
        $libro->save();

        // Redirigir a la pasarela de pagos
        return redirect()->route('pago', $factura->id);
    }
}
