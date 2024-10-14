<?php

namespace App\Http\Controllers;
use App\Models\Informe;

use Illuminate\Http\Request;

class InformeController extends Controller
{
    public function index()
    {
        $informe = Informe::orderBy('name', 'asc')->get();
         return response()->json(['data' => $informe], 200);
        // return "Hola mundo";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $informe = Informe::create($request->all());
        return response()->json(['data' => $informe], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Informe $informe)
    {
        return response()->json(['data' => $informe], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informe $informe)
    {
        $informe->update($request->all());
         return response()->json(['data' => $informe], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informe $informe)
    {
        $informe->delete();
         return response(null, 204);
    }
}
