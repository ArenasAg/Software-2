<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\Cliente;
use App\Models\MetodoPago;
use App\Models\Libro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\FacturaExport;
use Carbon\Carbon;

class FacturaController extends Controller
{
    public function index(Request $request)
    {
        $facturas = Factura::with('detalles.libro')->paginate(5);
        $clientes = Cliente::all();
        $metodoPagos = MetodoPago::all();
        $libros = Libro::all();
        if ($request->ajax()) {
            return response()->json([
                'facturas' => $facturas,
                'clientes' => $clientes,
                'metodoPagos' => $metodoPagos,
                'libros' => $libros
            ]);
        }
        return view('facturas.index', compact('facturas', 'clientes', 'metodoPagos', 'libros'));
    }

    public function show($id)
    {
        $factura = Factura::with('detalles.libro')->findOrFail($id);
        return response()->json($factura);
    }

    public function create()
    {
        $clientes = Cliente::all();
        $metodoPagos = MetodoPago::all();
        $libros = Libro::all();
        return view('facturas.create', compact('clientes', 'metodoPagos', 'libros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'fecha' => 'required|date|before_or_equal:today',
            'subtotal' => 'required|numeric',
            'total_impuestos' => 'required|numeric',
            'total' => 'required|numeric',
            'estado' => 'required',
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

            return redirect()->route('facturas.index')->with('success', 'Factura creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la factura: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $factura = Factura::with('detalles.libro')->findOrFail($id);
        $clientes = Cliente::all();
        $metodoPagos = MetodoPago::all();
        $libros = Libro::all();
        return view('facturas.edit', compact('factura', 'clientes', 'metodoPagos', 'libros'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required',
            'fecha' => 'required|date|before_or_equal:today',
            'subtotal' => 'required|numeric',
            'total_impuestos' => 'required|numeric',
            'total' => 'required|numeric',
            'estado' => 'required',
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
            $factura = Factura::findOrFail($id);
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

            return redirect()->route('facturas.index')->with('success', 'Factura actualizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la factura: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DetalleFactura::where('factura_id', $id)->delete();
            Factura::destroy($id);
            return redirect()->route('facturas.index')->with('success', 'Factura eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la factura: ' . $e->getMessage());
        }
    }

    public function export($format)
    {
        $facturas = Factura::all();
        if ($format === 'excel') {
            $export = new FacturaExport();
            return $export->export();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.facturas_pdf', compact('facturas'));
            return $pdf->download('facturas.pdf');
        }

        return redirect()->back()->with('error', 'Formato no soportado');
    }
}
