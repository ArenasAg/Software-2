<?php
namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Libro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $facturasEmitidas = Factura::count();
        $clientesActivos = Cliente::where('activo', 'true')->count();
        $ingresosMensuales = Factura::sum('total');

        $ultimasFacturas = Factura::orderBy('created_at', 'desc')->take(5)->get();
        $clientesRecientes = Cliente::orderBy('created_at', 'desc')->take(5)->get();

        // Datos para los gráficos
        $facturasPorMes = Factura::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        $ingresosPorMes = Factura::selectRaw('MONTH(created_at) as mes, SUM(total) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        return view('dashboard', compact(
            'facturasEmitidas',
            'clientesActivos',
            'ingresosMensuales',
            'ultimasFacturas',
            'clientesRecientes',
            'facturasPorMes',
            'ingresosPorMes'
        ));
    }
}
