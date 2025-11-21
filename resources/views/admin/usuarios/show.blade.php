<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Información del Usuario -->
                    <div class="flex items-center justify-between mb-6 pb-6 border-b">
                        <div class="flex items-center">
                            <div class="h-20 w-20 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                                <span class="text-indigo-700 font-bold text-2xl">
                                    {{ strtoupper(substr($usuario->name, 0, 2)) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">{{ $usuario->name }}</h3>
                                <p class="text-gray-600">{{ $usuario->email }}</p>
                            </div>
                        </div>
                        <div>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                       {{ $usuario->role == 'admin' ? 'bg-red-100 text-red-800' : '' }}
                                       {{ $usuario->role == 'empleado' ? 'bg-blue-100 text-blue-800' : '' }}
                                       {{ $usuario->role == 'cliente' ? 'bg-green-100 text-green-800' : '' }}">
                                {{ ucfirst($usuario->role) }}
                            </span>
                        </div>
                    </div>

                    <!-- Detalles -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Estado</h4>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                       {{ $usuario->activo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $usuario->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Fecha de Registro</h4>
                            <p class="text-gray-600">{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Última Actualización</h4>
                            <p class="text-gray-600">{{ $usuario->updated_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Total de Citas</h4>
                            <p class="text-2xl font-bold text-indigo-600">{{ $usuario->citas->count() }}</p>
                        </div>
                    </div>

                    <!-- Historial de Citas -->
                    @if($usuario->citas->count() > 0)
                        <div class="mt-6 pt-6 border-t">
                            <h4 class="font-semibold text-lg mb-4">📅 Historial de Citas</h4>
                            <div class="space-y-3 max-h-96 overflow-y-auto">
                                @foreach($usuario->citas->sortByDesc('fecha') as $cita)
                                    <div class="border rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-semibold">
                                                    📅 {{ $cita->fecha->format('d/m/Y') }} - 
                                                    🕐 {{ date('g:i A', strtotime($cita->hora)) }}
                                                </p>
                                                <div class="flex flex-wrap gap-1 mt-2">
                                                    @foreach($cita->servicios as $servicio)
                                                        <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded">
                                                            {{ $servicio->nombre }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="px-2 py-1 rounded text-xs font-semibold
                                                           {{ $cita->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                           {{ $cita->estado == 'confirmada' ? 'bg-green-100 text-green-800' : '' }}
                                                           {{ $cita->estado == 'completada' ? 'bg-gray-100 text-gray-800' : '' }}
                                                           {{ $cita->estado == 'cancelada' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ ucfirst($cita->estado) }}
                                                </span>
                                                <p class="mt-2 font-bold text-indigo-600">
                                                    ${{ number_format($cita->total, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Botones de Acción -->
                    <div class="flex space-x-3 mt-6 pt-6 border-t">
                        <a href="{{ route('admin.usuarios.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                            ← Volver
                        </a>

                        <a href="{{ route('admin.usuarios.edit', $usuario) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                            Editar Usuario
                        </a>

                        @if($usuario->id != auth()->id())
                            <form method="POST" action="{{ route('admin.usuarios.toggle', $usuario) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="px-6 py-2 rounded-lg text-white
                                               {{ $usuario->activo ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }}">
                                    {{ $usuario->activo ? 'Desactivar' : 'Activar' }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>