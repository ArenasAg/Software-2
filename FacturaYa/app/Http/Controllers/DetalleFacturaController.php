<?php

namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use App\Models\Producto;
use App\Models\Factura;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    public function index()
    {
        $detalleFacturas = DetalleFactura::all();
        return view('detalleFacturas.index', compact('detalleFacturas'));
    }

    public function create()
    {
        $facturas = Factura::all();
        $productos = Producto::all();
        return view('detalleFacturas.create', compact('productos', 'facturas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cantidad' => 'required|integer',
            'valor_total' => 'required|numeric',
            'descuento' => 'nullable|numeric',
            'producto_id' => 'required|exists:productos,id',
            'factura_id' => 'required|exists:facturas,id'
        ]);

        DetalleFactura::create($request->all());

        return redirect()->route('detalleFacturas.index')->with('success', 'Detalle de Factura creada con éxito.');
    }

    public function edit($id)
    {
        $detalleFactura = DetalleFactura::findOrFail($id);
        return view('detalleFacturas.edit', compact('detalleFactura'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer',
            'valor_total' => 'required|numeric',
            'descuento' => 'nullable|numeric',
            'producto_id' => 'required|exists:productos,id',
            'factura_id' => 'required|exists:facturas,id'
        ]);

        $detalleFactura = DetalleFactura::findOrFail($id);
        $detalleFactura->update($request->all());

        return redirect()->route('detalleFacturas.index')->with('success', 'Detalle de Factura actualizada con éxito.');
    }

    public function destroy($id)
    {
        DetalleFactura::destroy($id);
        return redirect()->route('detalleFacturas.index')->with('success', 'Detalle de Factura eliminada con éxito.');
    }
}
