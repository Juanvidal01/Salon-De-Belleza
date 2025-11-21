<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\HorarioDisponible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitaConfirmada;
use Carbon\Carbon;

class CitaController extends Controller
{
    /**
     * Mostrar citas del usuario autenticado
     */
    public function index()
    {
        $citas = Cita::with('servicios')
                     ->where('user_id', auth()->id())
                     ->orderByDesc('fecha')
                     ->orderByDesc('hora')
                     ->paginate(10);

        return view('citas.index', compact('citas'));
    }

    /**
     * Formulario para crear nueva cita (con calendario)
     */
    public function create()
    {
        $servicios = Servicio::where('activo', true)->get();
        $horarios = HorarioDisponible::where('activo', true)->get();

        return view('citas.create', compact('servicios', 'horarios'));
    }

    /**
     * Guardar nueva cita
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'servicios' => 'required|array|min:1',
            'servicios.*' => 'exists:servicios,id',
            'notas' => 'nullable|string|max:500'
        ]);

        DB::beginTransaction();
        try {
            // Verificar disponibilidad
            $existe = Cita::where('fecha', $validated['fecha'])
                          ->where('hora', $validated['hora'])
                          ->whereIn('estado', ['pendiente', 'confirmada'])
                          ->exists();

            if ($existe) {
                return back()->with('error', 'Ya existe una cita en ese horario. Por favor selecciona otro.');
            }

            // Obtener servicios y calcular total
            $servicios = Servicio::whereIn('id', $validated['servicios'])->get();
            $total = $servicios->sum('precio');

            // Crear la cita
            $cita = Cita::create([
                'user_id' => auth()->id(),
                'fecha' => $validated['fecha'],
                'hora' => $validated['hora'],
                'total' => $total,
                'estado' => 'pendiente',
                'notas' => $validated['notas'] ?? null
            ]);

            // Asociar servicios con el precio actual
            foreach ($servicios as $servicio) {
                $cita->servicios()->attach($servicio->id, [
                    'precio' => $servicio->precio
                ]);
            }

            // Enviar email de confirmación
            try {
                Mail::to(auth()->user()->email)->send(new CitaConfirmada($cita));
            } catch (\Exception $e) {
                // Log error pero no fallar la transacción
                \Log::error('Error enviando email: ' . $e->getMessage());
            }

            DB::commit();

            return redirect()->route('citas.show', $cita)
                           ->with('success', '¡Cita reservada exitosamente! Revisa tu email para más detalles.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Hubo un error al crear la cita: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar detalles de una cita
     */
    public function show(Cita $cita)
    {
        // Verificar que la cita pertenezca al usuario o sea admin/empleado
        if ($cita->user_id !== auth()->id() && 
            !auth()->user()->isAdmin() && 
            !auth()->user()->isEmpleado()) {
            abort(403, 'No tienes permiso para ver esta cita.');
        }

        $cita->load('servicios', 'user');
        return view('citas.show', compact('cita'));
    }

    /**
     * Formulario de edición (solo si está pendiente)
     */
    public function edit(Cita $cita)
    {
        if ($cita->user_id !== auth()->id()) {
            abort(403);
        }

        if ($cita->estado !== 'pendiente') {
            return back()->with('error', 'Solo puedes editar citas pendientes.');
        }

        $servicios = Servicio::where('activo', true)->get();
        $horarios = HorarioDisponible::where('activo', true)->get();

        return view('citas.edit', compact('cita', 'servicios', 'horarios'));
    }

    /**
     * Actualizar cita
     */
    public function update(Request $request, Cita $cita)
    {
        if ($cita->user_id !== auth()->id()) {
            abort(403);
        }

        if ($cita->estado !== 'pendiente') {
            return back()->with('error', 'Solo puedes editar citas pendientes.');
        }

        $validated = $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'servicios' => 'required|array|min:1',
            'servicios.*' => 'exists:servicios,id',
            'notas' => 'nullable|string|max:500'
        ]);

        DB::beginTransaction();
        try {
            // Verificar disponibilidad (excepto la cita actual)
            $existe = Cita::where('fecha', $validated['fecha'])
                          ->where('hora', $validated['hora'])
                          ->where('id', '!=', $cita->id)
                          ->whereIn('estado', ['pendiente', 'confirmada'])
                          ->exists();

            if ($existe) {
                return back()->with('error', 'Ya existe una cita en ese horario.');
            }

            // Actualizar servicios y calcular nuevo total
            $servicios = Servicio::whereIn('id', $validated['servicios'])->get();
            $total = $servicios->sum('precio');

            $cita->update([
                'fecha' => $validated['fecha'],
                'hora' => $validated['hora'],
                'total' => $total,
                'notas' => $validated['notas'] ?? null
            ]);

            // Sincronizar servicios
            $syncData = [];
            foreach ($servicios as $servicio) {
                $syncData[$servicio->id] = ['precio' => $servicio->precio];
            }
            $cita->servicios()->sync($syncData);

            DB::commit();

            return redirect()->route('citas.show', $cita)
                           ->with('success', 'Cita actualizada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar la cita.');
        }
    }

    /**
     * Cancelar cita
     */
    public function destroy(Cita $cita)
    {
        if ($cita->user_id !== auth()->id() && 
            !auth()->user()->isAdmin() && 
            !auth()->user()->isEmpleado()) {
            abort(403);
        }

        $cita->update(['estado' => 'cancelada']);

        return redirect()->route('citas.index')
                       ->with('success', 'Cita cancelada exitosamente.');
    }

    /**
     * Vista administrativa de todas las citas
     */
    public function adminIndex(Request $request)
    {
        $query = Cita::with(['user', 'servicios']);

        // Filtros
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('buscar')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->buscar . '%')
                  ->orWhere('email', 'like', '%' . $request->buscar . '%');
            });
        }

        $citas = $query->orderByDesc('fecha')
                      ->orderByDesc('hora')
                      ->paginate(20);

        return view('admin.citas.index', compact('citas'));
    }

    /**
     * Cambiar estado de cita (admin/empleado)
     */
    public function cambiarEstado(Request $request, Cita $cita)
    {
        $validated = $request->validate([
            'estado' => 'required|in:pendiente,confirmada,completada,cancelada'
        ]);

        $cita->update(['estado' => $validated['estado']]);

        return back()->with('success', 'Estado de la cita actualizado.');
    }

    /**
 * API: Obtener horarios disponibles para una fecha
 */
public function horariosDisponibles(Request $request)
{
    try {
        $fecha = $request->input('fecha');
        
        if (!$fecha) {
            return response()->json([
                'success' => false,
                'message' => 'Fecha no proporcionada'
            ]);
        }
        
        // Crear objeto Carbon y obtener día de la semana
        $carbon = \Carbon\Carbon::parse($fecha);
        $diaSemanaIngles = $carbon->format('l'); // Monday, Tuesday, etc.
        
        // Traducir el día al español
        $diasTraduccion = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miercoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sabado',
            'Sunday' => 'domingo'
        ];
        
        $diaSemana = $diasTraduccion[$diaSemanaIngles] ?? 'lunes';
        
        // Obtener horario del día
        $horario = \App\Models\HorarioDisponible::where('dia_semana', $diaSemana)
                                    ->where('activo', true)
                                    ->first();

        if (!$horario) {
            return response()->json([
                'success' => false,
                'message' => 'No hay horarios disponibles para ' . ucfirst($diaSemana)
            ]);
        }

        // Generar todos los horarios posibles
        $horariosGenerados = [];
        $inicio = \Carbon\Carbon::parse($horario->hora_inicio);
        $fin = \Carbon\Carbon::parse($horario->hora_fin);

        while ($inicio->lessThan($fin)) {
            $horariosGenerados[] = $inicio->format('H:i');
            $inicio->addMinutes($horario->intervalo_minutos);
        }

        // Obtener citas ya reservadas para esa fecha
        $citasReservadas = \App\Models\Cita::where('fecha', $fecha)
                           ->whereIn('estado', ['pendiente', 'confirmada'])
                           ->pluck('hora')
                           ->map(function($hora) {
                               return \Carbon\Carbon::parse($hora)->format('H:i');
                           })
                           ->toArray();

        // Filtrar horarios disponibles
        $horariosDisponibles = array_diff($horariosGenerados, $citasReservadas);

        return response()->json([
            'success' => true,
            'horarios' => array_values($horariosDisponibles),
            'debug' => [
                'dia_semana' => $diaSemana,
                'total_generados' => count($horariosGenerados),
                'total_reservados' => count($citasReservadas),
                'total_disponibles' => count($horariosDisponibles)
            ]
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Error en horariosDisponibles: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());
        
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener horarios',
            'error' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Traducir nombre del día al formato de la BD
     */
    private function traducirDia($dia)
    {
        $dias = [
            'monday' => 'lunes',
            'tuesday' => 'martes',
            'wednesday' => 'miercoles',
            'thursday' => 'jueves',
            'friday' => 'viernes',
            'saturday' => 'sabado',
            'sunday' => 'domingo'
        ];

        return $dias[strtolower($dia)] ?? 'lunes';
    }
}