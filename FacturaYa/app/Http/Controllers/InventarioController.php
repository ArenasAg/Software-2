<?php

namespace App\Http\Controllers;
use App\Models\Inventario;

use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $inventario = Inventario::all();
         return response()->json(['data' => $inventario], 200);
        // return "Hola mundo";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inventario = Inventario::create($request->all());
        return response()->json(['data' => $inventario], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        return response()->json(['data' => $inventario], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        $inventario->update($request->all());
         return response()->json(['data' => $inventario], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->delete();
         return response(null, 204);
    }
}
