<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HorarioDisponible;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Mostrar horarios disponibles
     */
    public function index()
    {
        $horarios = HorarioDisponible::orderByRaw("
            FIELD(dia_semana, 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo')
        ")->get();

        return view('admin.horarios.index', compact('horarios'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return view('admin.horarios.create');
    }

    /**
     * Guardar nuevo horario
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dia_semana' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'intervalo_minutos' => 'required|integer|min:15|max:120',
            'activo' => 'boolean'
        ]);

        // Verificar que no exista ya un horario para ese día
        $existe = HorarioDisponible::where('dia_semana', $validated['dia_semana'])->exists();
        
        if ($existe) {
            return back()->with('error', 'Ya existe un horario configurado para ese día. Edítalo en lugar de crear uno nuevo.');
        }

        $validated['activo'] = $request->has('activo');

        HorarioDisponible::create($validated);

        return redirect()->route('admin.horarios.index')
                        ->with('success', 'Horario creado exitosamente.');
    }

    /**
     * Formulario de edición
     */
    public function edit(HorarioDisponible $horario)
    {
        return view('admin.horarios.edit', compact('horario'));
    }

    /**
     * Actualizar horario
     */
    public function update(Request $request, HorarioDisponible $horario)
    {
        $validated = $request->validate([
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'intervalo_minutos' => 'required|integer|min:15|max:120',
            'activo' => 'boolean'
        ]);

        $validated['activo'] = $request->has('activo');

        $horario->update($validated);

        return redirect()->route('admin.horarios.index')
                        ->with('success', 'Horario actualizado exitosamente.');
    }

    /**
     * Eliminar horario
     */
    public function destroy(HorarioDisponible $horario)
    {
        $horario->delete();

        return redirect()->route('admin.horarios.index')
                        ->with('success', 'Horario eliminado exitosamente.');
    }

    /**
     * Activar/Desactivar horario
     */
    public function toggle(HorarioDisponible $horario)
    {
        $horario->update(['activo' => !$horario->activo]);

        return back()->with('success', 'Estado del horario actualizado.');
    }
}