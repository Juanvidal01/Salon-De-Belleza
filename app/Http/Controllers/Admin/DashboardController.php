<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\User;
use App\Models\Servicio;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $stats = [
            'citas_hoy' => Cita::whereDate('fecha', today())->count(),
            'citas_pendientes' => Cita::where('estado', 'pendiente')->count(),
            'total_clientes' => User::where('role', 'cliente')->where('activo', true)->count(),
            'ingresos_mes' => Cita::whereMonth('fecha', now()->month)
                                  ->whereYear('fecha', now()->year)
                                  ->where('estado', 'completada')
                                  ->sum('total'),
        ];

        // Citas del día
        $citasHoy = Cita::with(['user', 'servicios'])
                        ->whereDate('fecha', today())
                        ->orderBy('hora')
                        ->get();

        // Próximas citas
        $proximasCitas = Cita::with(['user', 'servicios'])
                             ->where('fecha', '>=', today())
                             ->where('estado', '!=', 'cancelada')
                             ->orderBy('fecha')
                             ->orderBy('hora')
                             ->limit(10)
                             ->get();

        // Servicios más solicitados (último mes)
        $serviciosPopulares = DB::table('cita_servicio')
            ->join('servicios', 'cita_servicio.servicio_id', '=', 'servicios.id')
            ->join('citas', 'cita_servicio.cita_id', '=', 'citas.id')
            ->where('citas.fecha', '>=', now()->subMonth())
            ->select('servicios.nombre', DB::raw('COUNT(*) as total'))
            ->groupBy('servicios.nombre')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Clientes recientes
        $clientesRecientes = User::where('role', 'cliente')
                                 ->latest()
                                 ->limit(5)
                                 ->get();

        return view('admin.dashboard', compact(
            'stats',
            'citasHoy',
            'proximasCitas',
            'serviciosPopulares',
            'clientesRecientes'
        ));
    }
}