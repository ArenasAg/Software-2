<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\Cliente;
use App\Models\MetodoPago;
use App\Models\Libro;
use Illuminate\Http\Request;
use App\Http\Resources\FacturaCollection;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\FacturaExport;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'codigo');
        $type = $request->input('type', 'asc');

        $validSort = ["codigo", "total"];

        if (!in_array($sort, $validSort)) {
            $message = "Invalid sort field: $sort";
            return response()->json(['error' => $message], 400);
        }

        $validType = ["asc", "desc"];

        if (!in_array($type, $validType)) {
            $message = "Invalid sort type: $type";
            return response()->json(['error' => $message], 400);
        }

        $facturas = Factura::with('detalles.libro')->orderBy($sort, $type)->paginate(5);
        return response()->json(new FacturaCollection($facturas), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:50|unique:facturas',
            'fecha' => 'required|date|before_or_equal:today',
            'subtotal' => 'required|numeric',
            'total_impuestos' => 'required|numeric',
            'total' => 'required|numeric',
            'estado' => 'required|boolean',
            'cliente_id' => 'required|exists:clientes,id',
            'metodo_pago_id' => 'required|exists:metodo_pagos,id',
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1',
            'descuento' => 'required|array',
            'descuento.*' => 'numeric|min:0'
        ]);

        try {
            // Crear el registro en la tabla facturas
            $factura = Factura::create($request->only([
                'codigo', 'fecha', 'subtotal', 'total_impuestos', 'total', 'estado', 'cliente_id', 'metodo_pago_id'
            ]));

            // Crear los registros en la tabla detalle_facturas
            foreach ($request->libro_id as $index => $libro_id) {
                $precio_unitario = Libro::find($libro_id)->precio;
                $cantidad = $request->cantidad[$index];
                $descuento = $request->descuento[$index];
                $valor_total = ($precio_unitario * $cantidad) - $descuento;

                DetalleFactura::create([
                    'factura_id' => $factura->id,
                    'libro_id' => $libro_id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'valor_total' => $valor_total,
                    'descuento' => $descuento,
                ]);
            }

            return response()->json(['data' => $factura], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la factura: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        return response()->json(['data' => $factura], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:50|unique:facturas,codigo,' . $factura->id,
            'fecha' => 'required|date|before_or_equal:today',
            'subtotal' => 'required|numeric',
            'total_impuestos' => 'required|numeric',
            'total' => 'required|numeric',
            'estado' => 'required|boolean',
            'cliente_id' => 'required|exists:clientes,id',
            'metodo_pago_id' => 'required|exists:metodo_pagos,id',
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1',
            'descuento' => 'required|array',
            'descuento.*' => 'numeric|min:0'
        ]);

        try {
            $factura->update($request->only([
                'codigo', 'fecha', 'subtotal', 'total_impuestos', 'total', 'estado', 'cliente_id', 'metodo_pago_id'
            ]));

            // Eliminar los detalles existentes
            DetalleFactura::where('factura_id', $factura->id)->delete();

            // Crear los nuevos registros en la tabla detalle_facturas
            foreach ($request->libro_id as $index => $libro_id) {
                $precio_unitario = Libro::find($libro_id)->precio;
                $cantidad = $request->cantidad[$index];
                $descuento = $request->descuento[$index];
                $valor_total = ($precio_unitario * $cantidad) - $descuento;

                DetalleFactura::create([
                    'factura_id' => $factura->id,
                    'libro_id' => $libro_id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'valor_total' => $valor_total,
                    'descuento' => $descuento,
                ]);
            }

            return response()->json(['data' => $factura], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la factura: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        try {
            DetalleFactura::where('factura_id', $factura->id)->delete();
            $factura->delete();
            return response(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la factura: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Export the specified resource in the given format.
     */
    public function export($format)
    {
        $facturas = Factura::all();
        if ($format === 'excel') {
            $export = new FacturaExport();
            return $export->export();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.facturas_pdf', compact('facturas'));
            return $pdf->download('facturas.pdf');
        } else {
            return response()->json(['error' => 'Formato no soportado'], 400);
        }
    }
}