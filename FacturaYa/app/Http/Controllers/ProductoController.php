<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Impuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        $impuestos = Impuesto::all();
        return view('productos.create', compact('productos', 'categorias', 'impuestos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:productos',
            'nombre' => 'required',
            'imagen' => 'nullable|image',
            'precio' => 'required|numeric',
            'medida' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'impuesto_id' => 'required|exists:impuestos,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $filename = time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $data['imagen'] = $request->file('imagen')->storeAs('img', $filename, 'public');
        }

        Producto::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $impuestos = Impuesto::all();
        return view('productos.edit', compact('producto', 'categorias', 'impuestos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|unique:productos,codigo,' . $id,
            'nombre' => 'required',
            'imagen' => 'nullable|image',
            'precio' => 'required|numeric',
            'medida' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'impuesto_id' => 'required|exists:impuestos,id'
        ]);

        $producto = Producto::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior del sistema de archivos
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }

            // Guardar la nueva imagen
            $filename = time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $data['imagen'] = $request->file('imagen')->storeAs('img', $filename, 'public');
        }

        $producto->update($data);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        // Eliminar la imagen del sistema de archivos
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}
