<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestión de Horarios') }}
            </h2>
            <a href="{{ route('admin.horarios.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">
                + Nuevo Horario
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Horarios de Atención</h3>

                    <div class="space-y-4">
                        @php
                            $diasOrden = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
                            $diasNombres = [
                                'lunes' => 'Lunes',
                                'martes' => 'Martes',
                                'miercoles' => 'Miércoles',
                                'jueves' => 'Jueves',
                                'viernes' => 'Viernes',
                                'sabado' => 'Sábado',
                                'domingo' => 'Domingo'
                            ];
                        @endphp

                        @foreach($diasOrden as $dia)
                            @php
                                $horario = $horarios->firstWhere('dia_semana', $dia);
                            @endphp

                            <div class="border rounded-lg p-4 {{ $horario && $horario->activo ? 'border-green-300 bg-green-50' : 'border-gray-300 bg-gray-50' }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-32">
                                            <span class="font-bold text-lg">{{ $diasNombres[$dia] }}</span>
                                        </div>

                                        @if($horario)
                                            <div class="flex items-center space-x-4">
                                                <div>
                                                    <span class="text-sm text-gray-600">Apertura:</span>
                                                    <span class="font-semibold">{{ date('g:i A', strtotime($horario->hora_inicio)) }}</span>
                                                </div>
                                                <span class="text-gray-400">→</span>
                                                <div>
                                                    <span class="text-sm text-gray-600">Cierre:</span>
                                                    <span class="font-semibold">{{ date('g:i A', strtotime($horario->hora_fin)) }}</span>
                                                </div>
                                                <div class="ml-4">
                                                    <span class="text-sm text-gray-600">Intervalo:</span>
                                                    <span class="font-semibold">{{ $horario->intervalo_minutos }} min</span>
                                                </div>

                                                <form method="POST" action="{{ route('admin.horarios.toggle', $horario) }}" class="ml-4">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors
                                                                   {{ $horario->activo ? 'bg-green-600' : 'bg-gray-300' }}">
                                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform
                                                                     {{ $horario->activo ? 'translate-x-6' : 'translate-x-1' }}">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-500 italic">Sin horario configurado</span>
                                        @endif
                                    </div>

                                    <div class="flex space-x-2">
                                        @if($horario)
                                            <a href="{{ route('admin.horarios.edit', $horario) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                                                Editar
                                            </a>
                                            <form method="POST" 
                                                  action="{{ route('admin.horarios.destroy', $horario) }}" 
                                                  class="inline"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este horario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                                                    Eliminar
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('admin.horarios.create') }}" 
                                               class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded text-sm">
                                                Configurar
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <h4 class="font-semibold text-blue-900 mb-2">ℹ️ Información</h4>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Los días con horarios activos (verde) están disponibles para reservar citas</li>
                            <li>• Los días inactivos no aparecerán como opción al crear una cita</li>
                            <li>• El intervalo determina cada cuántos minutos se puede agendar una cita</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>