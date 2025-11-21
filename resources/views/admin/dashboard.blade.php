<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Administrativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tarjetas de Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Citas Hoy -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Citas Hoy</p>
                            <p class="text-3xl font-bold">{{ $stats['citas_hoy'] }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Citas Pendientes -->
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm">Pendientes</p>
                            <p class="text-3xl font-bold">{{ $stats['citas_pendientes'] }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Clientes -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">Clientes Activos</p>
                            <p class="text-3xl font-bold">{{ $stats['total_clientes'] }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Ingresos del Mes -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm">Ingresos Mes</p>
                            <p class="text-3xl font-bold">${{ number_format($stats['ingresos_mes'], 0) }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Citas de Hoy -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        Citas de Hoy
                    </h3>

                    @if($citasHoy->count() > 0)
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            @foreach($citasHoy as $cita)
                                <div class="border-l-4 {{ $cita->estado == 'confirmada' ? 'border-green-500' : 'border-yellow-500' }} bg-gray-50 p-3 rounded">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold">{{ $cita->user->name }}</p>
                                            <p class="text-sm text-gray-600">
                                                🕐 {{ date('g:i A', strtotime($cita->hora)) }}
                                            </p>
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                @foreach($cita->servicios as $servicio)
                                                    <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded">
                                                        {{ $servicio->nombre }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <a href="{{ route('citas.show', $cita) }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm">
                                            Ver
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay citas programadas para hoy</p>
                    @endif

                    <div class="mt-4 pt-4 border-t">
                        <a href="{{ route('admin.citas.index') }}" 
                           class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">
                            Ver todas las citas →
                        </a>
                    </div>
                </div>

                <!-- Próximas Citas -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Próximas Citas
                    </h3>

                    @if($proximasCitas->count() > 0)
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            @foreach($proximasCitas as $cita)
                                <div class="border-l-4 border-blue-500 bg-gray-50 p-3 rounded">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold">{{ $cita->user->name }}</p>
                                            <p class="text-sm text-gray-600">
                                                📅 {{ $cita->fecha->format('d/m/Y') }} - 🕐 {{ date('g:i A', strtotime($cita->hora)) }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $cita->servicios->pluck('nombre')->implode(', ') }}
                                            </p>
                                        </div>
                                        <span class="text-sm font-semibold text-indigo-600">
                                            ${{ number_format($cita->total, 2) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay próximas citas</p>
                    @endif
                </div>
            </div>

            <!-- Servicios Más Solicitados y Clientes Recientes -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Servicios Populares -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        Servicios Más Solicitados
                    </h3>

                    @if($serviciosPopulares->count() > 0)
                        <div class="space-y-3">
                            @foreach($serviciosPopulares as $servicio)
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-sm font-medium">{{ $servicio->nombre }}</span>
                                            <span class="text-sm font-bold text-purple-600">{{ $servicio->total }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-purple-600 h-2 rounded-full" 
                                                 style="width: {{ ($servicio->total / $serviciosPopulares->max('total')) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay datos disponibles</p>
                    @endif
                </div>

                <!-- Clientes Recientes -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        Clientes Recientes
                    </h3>

                    @if($clientesRecientes->count() > 0)
                        <div class="space-y-3">
                            @foreach($clientesRecientes as $cliente)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                    <div>
                                        <p class="font-semibold">{{ $cliente->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $cliente->email }}</p>
                                    </div>
                                    <a href="{{ route('admin.usuarios.show', $cliente) }}" 
                                       class="text-indigo-600 hover:text-indigo-800 text-sm">
                                        Ver
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay clientes registrados</p>
                    @endif

                    <div class="mt-4 pt-4 border-t">
                        <a href="{{ route('admin.usuarios.index') }}" 
                           class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">
                            Ver todos los usuarios →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Accesos Rápidos -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold mb-4">⚡ Accesos Rápidos</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.citas.index') }}" 
                       class="bg-blue-50 hover:bg-blue-100 p-4 rounded-lg text-center transition">
                        <svg class="w-8 h-8 mx-auto mb-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        <p class="font-semibold text-sm">Gestionar Citas</p>
                    </a>

                    <a href="{{ route('admin.usuarios.index') }}" 
                       class="bg-green-50 hover:bg-green-100 p-4 rounded-lg text-center transition">
                        <svg class="w-8 h-8 mx-auto mb-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        <p class="font-semibold text-sm">Usuarios</p>
                    </a>

                    <a href="{{ route('admin.servicios.index') }}" 
                       class="bg-purple-50 hover:bg-purple-100 p-4 rounded-lg text-center transition">
                        <svg class="w-8 h-8 mx-auto mb-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                        </svg>
                        <p class="font-semibold text-sm">Servicios</p>
                    </a>

                    <a href="{{ route('admin.horarios.index') }}" 
                       class="bg-orange-50 hover:bg-orange-100 p-4 rounded-lg text-center transition">
                        <svg class="w-8 h-8 mx-auto mb-2 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <p class="font-semibold text-sm">Horarios</p>
                    </a>

                    <a href="{{ route('admin.reportes.index') }}"
                         class="bg-red-50 hover:bg-red-100 p-4 rounded-lg text-center transition">
                          <svg class="w-8 h-8 mx-auto mb-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V7.828a2 2 0 00-.586-1.414l-2.828-2.828A2 2 0 0013.172 3H4z" />
                       </svg>
                        <p class="font-semibold text-sm">Reportes</p>
                           </a>


                 

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>