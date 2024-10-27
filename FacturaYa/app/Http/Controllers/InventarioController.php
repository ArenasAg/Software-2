<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::all();
        return view('inventarios.index', compact('inventarios'));
    }

    public function create()
    {
        $productos = Producto::all();
        $inventarios = Inventario::all();
        return view('inventarios.create', compact('productos', 'inventarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'tipo_movimiento' => 'required|string',
            'producto_id' => 'required|exists:productos,id'
        ]);

        if ($request->tipo_movimiento === 'entrada') {
            $request->validate([
            'entrada' => 'required|integer',
            'salida' => 'nullable|integer'
            ]);
        } elseif ($request->tipo_movimiento === 'salida') {
            $request->validate([
            'entrada' => 'nullable|integer',
            'salida' => 'required|integer'
            ]);
        }

        Inventario::create($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Inventario creado con éxito.');
    }

    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);
        return view('inventarios.edit', compact('inventario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'tipo_movimiento' => 'required|string',
            'producto_id' => 'required|exists:productos,id'
        ]);

        if ($request->tipo_movimiento === 'entrada') {
            $request->validate([
            'entrada' => 'required|integer',
            'salida' => 'nullable|integer'
            ]);
        } elseif ($request->tipo_movimiento === 'salida') {
            $request->validate([
            'entrada' => 'nullable|integer',
            'salida' => 'required|integer'
            ]);
        }

        $inventario = Inventario::findOrFail($id);
        $inventario->update($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado con éxito.');
    }

    public function destroy($id)
    {
        Inventario::destroy($id);
        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado con éxito.');
    }
}
