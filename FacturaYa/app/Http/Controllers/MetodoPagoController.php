<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function index()
    {
        $metodoPagos = MetodoPago::all();
        return view('metodoPagos.index', compact('metodoPagos'));
    }

    public function create()
    {
        return view('metodoPagos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificador' => 'required|unique:metodo_pagos,identificador'
        ]);

        MetodoPago::create($request->all());

        return redirect()->route('metodoPagos.index')->with('success', 'Metodo de Pago creado con éxito.');
    }

    public function edit($id)
    {
        $metodoPago = MetodoPago::findOrFail($id);
        return view('metodoPagos.edit', compact('metodoPago'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificador' => 'required|unique:metodo_pagos,identificador' . $id
        ]);

        $metodoPago = MetodoPago::findOrFail($id);
        $metodoPago->update($request->all());

        return redirect()->route('metodoPagos.index')->with('success', 'Metodo de Pago actualizado con éxito.');
    }

    public function destroy($id)
    {
        MetodoPago::destroy($id);
        return redirect()->route('metodoPagos.index')->with('success', 'Metodo de Pago eliminado con éxito.');
    }
}
