<?php

namespace App\Http\Controllers;

use App\Models\Informe;
use Illuminate\Http\Request;

class InformeController extends Controller
{
    public function index()
    {
        $informes = Informe::all();
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

        return redirect()->route('informes.index')->with('success', 'Informe creado con éxito.');
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
}
