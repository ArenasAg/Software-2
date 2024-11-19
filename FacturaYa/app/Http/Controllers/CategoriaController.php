<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Exports\CategoriaExport;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::paginate(5);
        if ($request->ajax()) {
            return response()->json($categorias);
        }
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50'
        ]);

        Categoria::create($request->all());

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:50'
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria actualizada con éxito.');
    }

    public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect()->route('categorias.index')->with('success', 'Categoria eliminada con éxito.');
    }

    public function export($format)
    {
        $categorias = Categoria::all();
        if ($format === 'excel') {
            $export = new CategoriaExport();
            return $export->export();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.categorias_pdf', compact('categorias'));
            return $pdf->download('categorias.pdf');
        }

        return redirect()->back()->with('error', 'Formato no soportado');
    }
}
