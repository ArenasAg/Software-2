<?php

namespace App\Http\Controllers;
use App\Models\Factura;

use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $factura = Factura::orderBy('name', 'asc')->get();
         return response()->json(['data' => $factura], 200);
        // return "Hola mundo";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $factura = Factura::create($request->all());
        return response()->json(['data' => $factura], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        return response()->json(['data' => $factura], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        $factura->update($request->all());
         return response()->json(['data' => $factura], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        $factura->delete();
         return response(null, 204);
    }
}
