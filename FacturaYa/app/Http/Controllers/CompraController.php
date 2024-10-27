<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(15);
        $categorias = Categoria::all();
        return view('compras.index', compact('productos', 'categorias'));
    }
}
