<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Mostrar listado de servicios (para clientes)
     */
    public function index()
    {
        $servicios = Servicio::where('activo', true)
                            ->orderBy('nombre')
                            ->get();
        
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Mostrar un servicio específico
     */
    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));
    }

    /**
     * Vista de administración de servicios (solo admin)
     */
    public function admin()
    {
        $servicios = Servicio::orderBy('nombre')->get();
        return view('admin.servicios.index', compact('servicios'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return view('admin.servicios.create');
    }

    /**
     * Guardar nuevo servicio
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'duracion_minutos' => 'required|integer|min:15',
            'activo' => 'boolean'
        ]);

        Servicio::create($validated);

        return redirect()->route('admin.servicios.index')
                        ->with('success', 'Servicio creado exitosamente');
    }

    /**
     * Formulario de edición
     */
    public function edit(Servicio $servicio)
    {
        return view('admin.servicios.edit', compact('servicio'));
    }

    /**
     * Actualizar servicio
     */
    public function update(Request $request, Servicio $servicio)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'duracion_minutos' => 'required|integer|min:15',
            'activo' => 'boolean'
        ]);

        $servicio->update($validated);

        return redirect()->route('admin.servicios.index')
                        ->with('success', 'Servicio actualizado exitosamente');
    }

    /**
     * Eliminar servicio
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('admin.servicios.index')
                        ->with('success', 'Servicio eliminado exitosamente');
    }

    /**
     * Activar/Desactivar servicio
     */
    public function toggle(Servicio $servicio)
    {
        $servicio->update(['activo' => !$servicio->activo]);

        return back()->with('success', 'Estado del servicio actualizado');
    }
}