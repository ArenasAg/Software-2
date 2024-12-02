<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use App\Models\Impuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\LibroCollection;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LibroExport;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'nombre');
        $type = $request->input('type', 'asc');

        $validSort = ["nombre", "precio"];

        if (!in_array($sort, $validSort)) {
            $message = "Invalid sort field: $sort";
            return response()->json(['error' => $message], 400);
        }

        $validType = ["asc", "desc"];

        if (!in_array($type, $validType)) {
            $message = "Invalid sort type: $type";
            return response()->json(['error' => $message], 400);
        }

        $libros = Libro::orderBy($sort, $type)->paginate(5);
        $categorias = Categoria::all();
        $impuestos = Impuesto::all();

        return response()->json([
            'libros' => new LibroCollection($libros),
            'categorias' => $categorias,
            'impuestos' => $impuestos,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|unique:libros',
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image',
            'precio' => 'required|numeric',
            'medida' => 'required|string|max:255',
            'stock' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'impuesto_id' => 'required|exists:impuestos,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $filename = time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $data['imagen'] = $request->file('imagen')->storeAs('img', $filename, 'public');
        }

        $libro = Libro::create($data);

        return response()->json(['data' => $libro], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        return response()->json(['data' => $libro], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $validated = $request->validate([
            'codigo' => 'required|unique:libros,codigo,' . $libro->id,
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image',
            'precio' => 'required|numeric',
            'medida' => 'required|string|max:255',
            'stock' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'impuesto_id' => 'required|exists:impuestos,id'
        ]);

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

        return response()->json(['data' => $libro], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        // Eliminar la imagen del sistema de archivos
        if ($libro->imagen) {
            Storage::disk('public')->delete($libro->imagen);
        }

        $libro->delete();

        return response(null, 204);
    }

    /**
     * Search for resources based on query.
     */
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

        return response()->json(['data' => $libros], 200);
    }

    /**
     * Filter resources based on sort criteria.
     */
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
        return response()->json(['data' => $libros], 200);
    }

    /**
     * Export the specified resource in the given format.
     */
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