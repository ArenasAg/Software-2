<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;
use App\Http\Resources\MetodoPagoCollection;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\MetodoPagoExport;

class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'nombre');
        $type = $request->input('type', 'asc');

        $validSort = ["nombre", "identificador"];

        if (!in_array($sort, $validSort)) {
            $message = "Invalid sort field: $sort";
            return response()->json(['error' => $message], 400);
        }

        $validType = ["asc", "desc"];

        if (!in_array($type, $validType)) {
            $message = "Invalid sort type: $type";
            return response()->json(['error' => $message], 400);
        }

        $metodoPagos = MetodoPago::orderBy($sort, $type)->paginate(5);
        return response()->json(new MetodoPagoCollection($metodoPagos), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'identificador' => 'required|unique:metodo_pagos,identificador'
        ]);

        $metodoPago = MetodoPago::create($validated);

        return response()->json(['data' => $metodoPago], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MetodoPago $metodoPago)
    {
        return response()->json(['data' => $metodoPago], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetodoPago $metodoPago)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'identificador' => 'required|unique:metodo_pagos,identificador,' . $metodoPago->id
        ]);

        $metodoPago->update($validated);

        return response()->json(['data' => $metodoPago], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetodoPago $metodoPago)
    {
        $metodoPago->delete();

        return response(null, 204);
    }

    /**
     * Search for resources based on query.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $metodoPagos = MetodoPago::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('identificador', 'LIKE', "%{$query}%")
            ->orWhere('id', 'LIKE', "%{$query}%")
            ->get();

        return response()->json(['data' => $metodoPagos], 200);
    }

    /**
     * Filter resources based on sort criteria.
     */
    public function filter(Request $request)
    {
        $sort = $request->input('sort');
        $metodoPagos = MetodoPago::query();

        if ($sort == 'name_asc') {
            $metodoPagos->orderBy('nombre', 'asc');
        } elseif ($sort == 'name_desc') {
            $metodoPagos->orderBy('nombre', 'desc');
        } elseif ($sort == 'recent') {
            $metodoPagos->orderBy('created_at', 'desc');
        } elseif ($sort == 'oldest') {
            $metodoPagos->orderBy('created_at', 'asc');
        }

        $metodoPagos = $metodoPagos->get();
        return response()->json(['data' => $metodoPagos], 200);
    }

    /**
     * Export the specified resource in the given format.
     */
    public function export($format)
    {
        $metodoPagos = MetodoPago::all();

        if ($format === 'excel') {
            $export = new MetodoPagoExport();
            return $export->export();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.metodo_pagos_pdf', compact('metodoPagos'));
            return $pdf->download('metodo_pagos.pdf');
        }

        return redirect()->back()->with('error', 'Formato no soportado');
    }
}