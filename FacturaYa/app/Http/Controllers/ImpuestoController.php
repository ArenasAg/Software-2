<?php

namespace App\Http\Controllers;
use App\Models\Impuesto;

use Illuminate\Http\Request;

class ImpuestoController extends Controller
{
    public function index()
    {
        $impuesto = Impuesto::orderBy('name', 'asc')->get();
         return response()->json(['data' => $impuesto], 200);
        // return "Hola mundo";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $impuesto = Impuesto::create($request->all());
        return response()->json(['data' => $impuesto], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Impuesto $impuesto)
    {
        return response()->json(['data' => $impuesto], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Impuesto $impuesto)
    {
        $impuesto->update($request->all());
         return response()->json(['data' => $impuesto], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Impuesto $impuesto)
    {
        $impuesto->delete();
         return response(null, 204);
    }
}
