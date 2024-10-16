<?php

namespace App\Http\Controllers;
use App\Models\DetalleFactura;

use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    public function index()
    {
        $detalleFactura = DetalleFactura::all();
         return response()->json(['data' => $detalleFactura], 200);
        // return "Hola mundo";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $detalleFactura = DetalleFactura::create($request->all());
        return response()->json(['data' => $detalleFactura], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DetalleFactura $detalleFactura)
    {
        return response()->json(['data' => $detalleFactura], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleFactura $detalleFactura)
    {
        $detalleFactura->update($request->all());
         return response()->json(['data' => $detalleFactura], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetalleFactura $detalleFactura)
    {
        $detalleFactura->delete();
         return response(null, 204);
    }
}
