<?php

namespace App\Http\Controllers;

use App\Models\Informe;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\InformeExport;

class InformeController extends Controller
{
    public function index(Request $request)
    {
        $informes = Informe::paginate(5);
        if ($request->ajax()) {
            return response()->json($informes);
        }
        return view('informes.index', compact('informes'));
    }

    public function create()
    {
        return view('informes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'tipo_informe' => 'required|string',
            'datos_json' => 'required|json'
        ]);

        Informe::create($request->all());

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $informe = Informe::findOrFail($id);
        return view('informes.edit', compact('informe'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'tipo_informe' => 'required|string',
            'datos_json' => 'required|json'
        ]);

        $informe = Informe::findOrFail($id);
        $informe->update($request->all());

        return redirect()->route('informes.index')->with('success', 'Informe actualizado con éxito.');
    }

    public function destroy($id)
    {
        Informe::destroy($id);
        return redirect()->route('informes.index')->with('success', 'Informe eliminado con éxito.');
    }

    public function export($format)
    {
        $informes = Informe::all();
        if ($format === 'excel') {
            $export = new InformeExport();
            return $export->export();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.informes_pdf', compact('informes'));
            return $pdf->download('informes.pdf');
        }

        return redirect()->back()->with('error', 'Formato no soportado');
    }
}
