<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Resources\ClienteCollection;
use App\Exports\ClienteExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'activo');
        $type = $request->input('type', 'asc');

        $validSort = ["activo", "ciudad"];

        if (!in_array($sort, $validSort)) {
            $message = "Invalid sort field: $sort";
            return response()->json(['error' => $message], 400);
        }

        $validType = ["asc", "desc"];

        if (!in_array($type, $validType)) {
            $message = "Invalid sort type: $type";
            return response()->json(['error' => $message], 400);
        }

        $clientes = Cliente::orderBy($sort, $type)->get();
        return response()->json(new ClienteCollection($clientes), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_documento' => 'required|string|max:20|unique:clientes',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'ciudad' => 'required|string|max:100',
            'activo' => 'required|boolean',
        ]);

        $cliente = Cliente::create($validated);

        return response()->json(['data' => $cliente], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return response()->json(['data' => $cliente], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'numero_documento' => 'required|string|max:20|unique:clientes,numero_documento,' . $cliente->id,
            'nombre' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'ciudad' => 'required|string|max:100',
            'activo' => 'required|boolean',
        ]);

        $cliente->update($validated);

        return response()->json(['data' => $cliente], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return response(null, 204);
    }

    /**
     * Export the specified resource in the given format.
     */
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