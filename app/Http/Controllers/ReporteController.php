<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Página principal de reportes
     */
    public function index()
    {
        // Métricas rápidas
        $totalClientes = User::count();
        $totalCitas    = Cita::count();
        $ingresosTotales = Cita::sum('total');

        // Últimas 5 citas para mostrar algo en la página
        $citasRecientes = Cita::with('user')
            ->latest('fecha')
            ->take(5)
            ->get();

        return view('reportes.index', compact(
            'totalClientes',
            'totalCitas',
            'ingresosTotales',
            'citasRecientes'
        ));
    }

    /**
     * PDF de citas en un rango de fechas
     */
    public function citasPDF(Request $request)
    {
        $fechaInicio = $request->query('fecha_inicio');
        $fechaFin    = $request->query('fecha_fin');

        $query = Cita::with('user');

        if ($fechaInicio) {
            $query->whereDate('fecha', '>=', $fechaInicio);
        }

        if ($fechaFin) {
            $query->whereDate('fecha', '<=', $fechaFin);
        }

        $citas = $query->orderBy('fecha')->orderBy('hora')->get();

        $data = [
            'titulo'       => 'Reporte de Citas',
            'fecha'        => Carbon::now()->format('d/m/Y H:i:s'),
            'fechaInicio'  => $fechaInicio,
            'fechaFin'     => $fechaFin,
            'citas'        => $citas,
            'totalCitas'   => $citas->count(),
            'totalIngresos'=> $citas->sum('total'),
        ];

        $pdf = Pdf::loadView('reportes.citas-pdf', $data);
        $pdf->setPaper('letter', 'portrait');

        return $pdf->download('reporte-citas-' . date('Y-m-d') . '.pdf');
        // si prefieres ver en navegador:
        // return $pdf->stream('reporte-citas.pdf');
    }
}
