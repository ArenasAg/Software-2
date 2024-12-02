<?php

namespace App\Http\Controllers;

use App\Models\Impuesto;
use Illuminate\Http\Request;
use App\Http\Resources\ImpuestoCollection;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ImpuestoExport;

class ImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'nombre');
        $type = $request->input('type', 'asc');

        $validSort = ["nombre", "porcentaje"];

        if (!in_array($sort, $validSort)) {
            $message = "Invalid sort field: $sort";
            return response()->json(['error' => $message], 400);
        }

        $validType = ["asc", "desc"];

        if (!in_array($type, $validType)) {
            $message = "Invalid sort type: $type";
            return response()->json(['error' => $message], 400);
        }

        $impuestos = Impuesto::orderBy($sort, $type)->paginate(5);
        return response()->json(new ImpuestoCollection($impuestos), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|min:0|max:100'
        ]);

        $impuesto = Impuesto::create($validated);

        return response()->json(['data' => $impuesto], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Impuesto $impuesto)
    {
        return response()->json(['data' => $impuesto], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Impuesto $impuesto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|min:0|max:100'
        ]);

        $impuesto->update($validated);

        return response()->json(['data' => $impuesto], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Impuesto $impuesto)
    {
        $impuesto->delete();

        return response(null, 204);
    }

    /**
     * Export the specified resource in the given format.
     */
    public function export($format)
    {
        $impuestos = Impuesto::all();
        if ($format === 'excel') {
            $export = new ImpuestoExport();
            return $export->export();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.impuestos_pdf', compact('impuestos'));
            return $pdf->download('impuestos.pdf');
        }

        return redirect()->back()->with('error', 'Formato no soportado');
    }
}