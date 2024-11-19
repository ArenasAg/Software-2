<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use App\Models\Impuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\LibroExport;
use Barryvdh\DomPDF\Facade\Pdf;

class LibroController extends Controller
{
    public function index(Request $request)
    {
        $libros = Libro::paginate(5);
        $categorias = Categoria::all();
        $impuestos = Impuesto::all();
        if ($request->ajax()) {
            return response()->json([
                'libros' => $libros,
                'categorias' => $categorias,
                'impuestos' => $impuestos
            ]);
        }
        return view('libros.index', compact('libros', 'categorias', 'impuestos'));
    }

    public function create()
    {
        $libros = Libro::all();
        $categorias = Categoria::all();
        $impuestos = Impuesto::all();
        return view('libros.create', compact('libros', 'categorias', 'impuestos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:libros',
            'nombre' => 'required',
            'imagen' => 'nullable|image',
            'precio' => 'required|numeric',
            'medida' => 'required',
            'stock' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'impuesto_id' => 'required|exists:impuestos,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $filename = time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $data['imagen'] = $request->file('imagen')->storeAs('img', $filename, 'public');
        }

        Libro::create($data);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        $categorias = Categoria::all();
        $impuestos = Impuesto::all();
        return view('libros.edit', compact('libro', 'categorias', 'impuestos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|unique:libros,codigo,' . $id,
            'nombre' => 'required',
            'imagen' => 'nullable|image',
            'precio' => 'required|numeric',
            'medida' => 'required',
            'stock' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'impuesto_id' => 'required|exists:impuestos,id'
        ]);

        $libro = Libro::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior del sistema de archivos
            if ($libro->imagen) {
                Storage::disk('public')->delete($libro->imagen);
            }

            // Guardar la nueva imagen
            $filename = time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $data['imagen'] = $request->file('imagen')->storeAs('img', $filename, 'public');
        }

        $libro->update($data);

        return redirect()->route('libros.index')->with('success', 'Libro actualizado con éxito.');
    }

    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);

        // Eliminar la imagen del sistema de archivos
        if ($libro->imagen) {
            Storage::disk('public')->delete($libro->imagen);
        }

        $libro->delete();

        return redirect()->route('libros.index')->with('success', 'Libro eliminado con éxito.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $libros = Libro::where('codigo', 'LIKE', "%{$query}%")
            ->orWhere('nombre', 'LIKE', "%{$query}%")
            ->orWhere('precio', 'LIKE', "%{$query}%")
            ->orWhere('medida', 'LIKE', "%{$query}%")
            ->orWhere('stock', 'LIKE', "%{$query}%")
            ->orWhere('categoria_id', 'LIKE', "%{$query}%")
            ->orWhere('impuesto_id', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($libros);
    }

    public function filter(Request $request)
    {
        $sort = $request->input('sort');
        $libros = Libro::query();

        if ($sort == 'name_asc') {
            $libros->orderBy('nombre', 'asc');
        } elseif ($sort == 'name_desc') {
            $libros->orderBy('nombre', 'desc');
        } elseif ($sort == 'recent') {
            $libros->orderBy('created_at', 'desc');
        } elseif ($sort == 'oldest') {
            $libros->orderBy('created_at', 'asc');
        }

        $libros = $libros->get();
        return response()->json($libros);
    }

    public function export($format)
    {

        $libros = Libro::all();
        if ($format === 'excel') {
            $export = new LibroExport();
            return $export->export();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.libros_pdf', compact('libros'));
            return $pdf->download('libros.pdf');
        }

        return redirect()->back()->with('error', 'Formato no soportado');
    }
}
