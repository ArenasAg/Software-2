<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;
use App\Exports\MetodoPagoExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Events\MetodoPagoUpdated;

class MetodoPagoController extends Controller
{
    public function index(Request $request)
    {
        $metodoPagos = MetodoPago::paginate(5);
        if ($request->ajax()) {
            return response()->json($metodoPagos);
        }
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

        $metodoPagos = MetodoPago::all();
        event(new MetodoPagoUpdated($metodoPagos));

        return response()->json(['success' => true]);
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
            'identificador' => 'required|unique:metodo_pagos,identificador,' . $id
        ]);

        $metodoPago = MetodoPago::findOrFail($id);
        $metodoPago->update($request->all());

        $metodoPagos = MetodoPago::all();
        event(new MetodoPagoUpdated($metodoPago));

        return redirect()->route('metodoPagos.index')->with('success', 'Metodo de Pago actualizado con éxito.');
    }

    public function destroy(Request $request, $id)
    {
        MetodoPago::destroy($id);

        $metodoPagos = MetodoPago::all();
        broadcast(new MetodoPagoUpdated($metodoPagos));

        return redirect()->route('metodoPagos.index')->with('success', 'Metodo de Pago eliminado con éxito.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $metodoPagos = MetodoPago::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('identificador', 'LIKE', "%{$query}%")
            ->orWhere('id', 'LIKE', "%{$query}%")
            // Agrega más campos según sea necesario
            ->get();

        return response()->json($metodoPagos);
    }

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
        return response()->json($metodoPagos);
    }

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
