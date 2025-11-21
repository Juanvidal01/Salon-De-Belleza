<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Mostrar lista de usuarios
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtros
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('activo')) {
            $query->where('activo', $request->activo);
        }

        if ($request->filled('buscar')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->buscar . '%')
                  ->orWhere('email', 'like', '%' . $request->buscar . '%');
            });
        }

        $usuarios = $query->orderBy('name')->paginate(15);

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Guardar nuevo usuario
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,empleado,cliente',
            'activo' => 'boolean'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['activo'] = $request->has('activo');

        User::create($validated);

        return redirect()->route('admin.usuarios.index')
                        ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Mostrar detalles de usuario
     */
    public function show(User $usuario)
    {
        $usuario->load('citas.servicios');
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Formulario de edición
     */
    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, User $usuario)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,empleado,cliente',
            'activo' => 'boolean'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['activo'] = $request->has('activo');

        $usuario->update($validated);

        return redirect()->route('admin.usuarios.index')
                        ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Eliminar usuario
     */
    public function destroy(User $usuario)
    {
        // No permitir eliminar el usuario actual
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        // No permitir eliminar si tiene citas
        if ($usuario->citas()->count() > 0) {
            return back()->with('error', 'No puedes eliminar un usuario con citas registradas.');
        }

        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
                        ->with('success', 'Usuario eliminado exitosamente.');
    }

    /**
     * Activar/Desactivar usuario
     */
    public function toggleActivo(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes desactivar tu propio usuario.');
        }

        $usuario->update(['activo' => !$usuario->activo]);

        $mensaje = $usuario->activo ? 'Usuario activado' : 'Usuario desactivado';
        return back()->with('success', $mensaje);
    }
}