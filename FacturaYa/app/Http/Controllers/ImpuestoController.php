<?php

namespace App\Http\Controllers;

use App\Models\Impuesto;
use Illuminate\Http\Request;

class ImpuestoController extends Controller
{
    public function index()
    {
        $impuestos = Impuesto::all();
        return view('impuestos.index', compact('impuestos'));
    }

    public function create()
    {
        return view('impuestos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|min:0|max:100'
        ]);

        Impuesto::create($request->all());

        return redirect()->route('impuestos.index')->with('success', 'Impuesto creado con éxito.');
    }

    public function edit($id)
    {
        $impuesto = Impuesto::findOrFail($id);
        return view('impuestos.edit', compact('impuesto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|min:0|max:100'
        ]);

        $impuesto = Impuesto::findOrFail($id);
        $impuesto->update($request->all());

        return redirect()->route('impuestos.index')->with('success', 'Impuesto actualizado con éxito.');
    }

    public function destroy($id)
    {
        Impuesto::destroy($id);
        return redirect()->route('impuestos.index')->with('success', 'Impuesto eliminado con éxito.');
    }
}
