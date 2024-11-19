<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\InventarioDetalle;
use App\Models\Libro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\InventarioExport;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $inventarios = Inventario::with('detalles.libro')->paginate(5);
        $libros = Libro::all();
        if ($request->ajax()) {
            return response()->json([
                'inventarios' => $inventarios,
                'libros' => $libros
            ]);
        }
        return view('inventarios.index', compact('inventarios', 'libros'));
    }

    public function create()
    {
        $libros = Libro::all();
        return view('inventarios.create', compact('libros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'tipo_movimiento' => 'required|string',
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1'
        ]);

        // Crear el registro en la tabla inventarios
        $inventario = Inventario::create([
            'fecha' => $request->fecha,
            'tipo_movimiento' => $request->tipo_movimiento,
        ]);

        // Crear los registros en la tabla inventario_detalles
        foreach ($request->libro_id as $index => $libro_id) {
            InventarioDetalle::create([
                'inventario_id' => $inventario->id,
                'libro_id' => $libro_id,
                'cantidad' => $request->cantidad[$index],
            ]);
        }

        return redirect()->route('inventarios.index')->with('success', 'Inventario creado exitosamente.');
    }

    public function edit($id)
    {
        $inventario = Inventario::with('detalles.libro')->findOrFail($id);
        $libros = Libro::all();
        return view('inventarios.edit', compact('inventario', 'libros'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'tipo_movimiento' => 'required|string',
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1'
        ]);

        $inventario = Inventario::findOrFail($id);
        $inventario->update([
            'fecha' => $request->fecha,
            'tipo_movimiento' => $request->tipo_movimiento,
        ]);

        // Eliminar los detalles existentes
        InventarioDetalle::where('inventario_id', $inventario->id)->delete();

        // Crear los nuevos registros en la tabla inventario_detalles
        foreach ($request->libro_id as $index => $libro_id) {
            InventarioDetalle::create([
                'inventario_id' => $inventario->id,
                'libro_id' => $libro_id,
                'cantidad' => $request->cantidad[$index],
            ]);
        }

        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado con éxito.');
    }

    public function destroy($id)
    {
        Inventario::destroy($id);
        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado con éxito.');
    }

    public function export($format)
    {
        $inventarios = Inventario::all();
        if ($format === 'excel') {
            $export = new InventarioExport();
            return $export->export();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.inventarios_pdf', compact('inventarios'));
            return $pdf->download('inventarios.pdf');
        }

        return redirect()->back()->with('error', 'Formato no soportado');
    }
}
