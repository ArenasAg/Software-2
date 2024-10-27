<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\MetodoPago;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::all();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $metodoPagos = MetodoPago::all();
        return view('facturas.create', compact('clientes', 'metodoPagos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'fecha' => 'required|date',
            'subtotal' => 'required|numeric',
            'total_impuestos' => 'required|numeric',
            'total' => 'required|numeric',
            'estado' => 'required',
            'cliente_id' => 'required|exists:clientes,id',
            'metodo_pago_id' => 'required|exists:metodo_pagos,id'
        ]);

        Factura::create($request->all());

        return redirect()->route('facturas.index')->with('success', 'Factura creada con éxito.');
    }

    public function edit($id)
    {
        $factura = Factura::findOrFail($id);
        return view('facturas.edit', compact('factura'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required',
            'fecha' => 'required|date',
            'subtotal' => 'required|numeric',
            'total_impuestos' => 'required|numeric',
            'total' => 'required|numeric',
            'estado' => 'required',
            'cliente_id' => 'required|exists:clientes,id',
            'metodo_pago_id' => 'required|exists:metodo_pagos,id'
        ]);

        $factura = Factura::findOrFail($id);
        $factura->update($request->all());

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada con éxito.');
    }

    public function destroy($id)
    {
        Factura::destroy($id);
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada con éxito.');
    }
}
