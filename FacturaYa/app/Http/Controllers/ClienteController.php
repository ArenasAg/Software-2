<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ClienteExport;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::paginate(5);
        if ($request->ajax()) {
            return response()->json($clientes);
        }
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required|string|max:20|unique:clientes,numero_documento',
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|email|unique:clientes,email',
            'ciudad' => 'nullable|string|max:100',
        ]);

        Cliente::create($request->all());

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_documento' => 'required|string|max:20|unique:clientes,numero_documento',
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|email',
            'ciudad' => 'nullable|string|max:100',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
    }

    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con éxito.');
    }

    public function export($format)
    {
        $clientes = Cliente::all();
        if ($format === 'excel') {
            $export = new ClienteExport();
            return $export->export();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.clientes_pdf', compact('clientes'));
            return $pdf->download('clientes.pdf');
        }

        return redirect()->back()->with('error', 'Formato no soportado');
    }
}
