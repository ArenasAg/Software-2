<?php

namespace App\Http\Controllers;

use App\Models\Impuesto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ImpuestoExport;

class ImpuestoController extends Controller
{
    public function index(Request $request)
    {
        $impuestos = Impuesto::paginate(5);
        if ($request->ajax()) {
            return response()->json($impuestos);
        }
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

        return response()->json(['success' => true]);
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
