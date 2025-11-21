<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filtros -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h3 class="font-semibold mb-4">🔍 Filtros</h3>
                <form method="GET" action="{{ route('admin.citas.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                        <input type="date" 
                               name="fecha" 
                               value="{{ request('fecha') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                        <select name="estado" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos</option>
                            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
                            <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Buscar Cliente</label>
                        <input type="text" 
                               name="buscar" 
                               value="{{ request('buscar') }}"
                               placeholder="Nombre o email..."
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="flex items-end space-x-2">
                        <button type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">
                            Filtrar
                        </button>
                        <a href="{{ route('admin.citas.index') }}" 
                           class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tabla de Citas -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">
                            Total: {{ $citas->total() }} cita(s)
                        </h3>
                        
                        <!-- Leyenda de Estados -->
                        <div class="flex space-x-3 text-xs">
                            <span class="flex items-center">
                                <span class="w-3 h-3 bg-yellow-400 rounded-full mr-1"></span>
                                Pendiente
                            </span>
                            <span class="flex items-center">
                                <span class="w-3 h-3 bg-green-400 rounded-full mr-1"></span>
                                Confirmada
                            </span>
                            <span class="flex items-center">
                                <span class="w-3 h-3 bg-gray-400 rounded-full mr-1"></span>
                                Completada
                            </span>
                            <span class="flex items-center">
                                <span class="w-3 h-3 bg-red-400 rounded-full mr-1"></span>
                                Cancelada
                            </span>
                        </div>
                    </div>

                    @if($citas->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha/Hora</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Servicios</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($citas as $cita)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                #{{ $cita->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $cita->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $cita->user->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">📅 {{ $cita->fecha->format('d/m/Y') }}</div>
                                                <div class="text-sm text-gray-500">🕐 {{ date('g:i A', strtotime($cita->hora)) }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($cita->servicios as $servicio)
                                                        <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded">
                                                            {{ $servicio->nombre }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">
                                                ${{ number_format($cita->total, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form method="POST" action="{{ route('admin.citas.cambiar-estado', $cita) }}" class="inline">
                                                    @csrf
                                                    <select name="estado" 
                                                            onchange="this.form.submit()"
                                                            class="text-sm rounded px-2 py-1 border-0 focus:ring-2
                                                                   {{ $cita->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800 focus:ring-yellow-500' : '' }}
                                                                   {{ $cita->estado == 'confirmada' ? 'bg-green-100 text-green-800 focus:ring-green-500' : '' }}
                                                                   {{ $cita->estado == 'completada' ? 'bg-gray-100 text-gray-800 focus:ring-gray-500' : '' }}
                                                                   {{ $cita->estado == 'cancelada' ? 'bg-red-100 text-red-800 focus:ring-red-500' : '' }}">
                                                        <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                        <option value="confirmada" {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                                        <option value="completada" {{ $cita->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                                                        <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <a href="{{ route('citas.show', $cita) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900">
                                                    Ver Detalle
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="mt-4">
                            {{ $citas->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay citas</h3>
                            <p class="mt-1 text-sm text-gray-500">No se encontraron citas con los filtros aplicados.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>