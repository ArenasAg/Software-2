<?php

namespace App\Http\Controllers;
use App\Models\MetodoPago;

use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function index()
    {
        $metodoPago = MetodoPago::orderBy('name', 'asc')->get();
         return response()->json(['data' => $metodoPago], 200);
        // return "Hola mundo";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $metodoPago = MetodoPago::create($request->all());
        return response()->json(['data' => $metodoPago], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MetodoPago $metodoPago)
    {
        return response()->json(['data' => $metodoPago], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetodoPago $metodoPago)
    {
        $metodoPago->update($request->all());
         return response()->json(['data' => $metodoPago], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetodoPago $metodoPago)
    {
        $metodoPago->delete();
         return response(null, 204);
    }
}
