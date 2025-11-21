<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mis Citas') }}
            </h2>
            <a href="{{ route('citas.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">
                + Nueva Cita
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($citas->count() > 0)
                        <div class="space-y-4">
                            @foreach($citas as $cita)
                                <div class="border rounded-lg p-4 hover:shadow-md transition
                                    @if($cita->estado == 'pendiente') border-yellow-300 bg-yellow-50
                                    @elseif($cita->estado == 'confirmada') border-green-300 bg-green-50
                                    @elseif($cita->estado == 'completada') border-gray-300 bg-gray-50
                                    @else border-red-300 bg-red-50
                                    @endif">
                                    
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3 mb-3">
                                                <span class="text-3xl">📅</span>
                                                <div>
                                                    <h3 class="font-bold text-lg">
                                                        {{ \Carbon\Carbon::parse($cita->fecha)->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                                                    </h3>
                                                    <p class="text-gray-600">
                                                        🕐 {{ date('g:i A', strtotime($cita->hora)) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <p class="font-semibold text-sm text-gray-700 mb-1">Servicios:</p>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach($cita->servicios as $servicio)
                                                        <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">
                                                            {{ $servicio->nombre }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="flex items-center space-x-4 text-sm">
                                                <span class="font-semibold">
                                                    Estado: 
                                                    <span class="
                                                        @if($cita->estado == 'pendiente') text-yellow-600
                                                        @elseif($cita->estado == 'confirmada') text-green-600
                                                        @elseif($cita->estado == 'completada') text-gray-600
                                                        @else text-red-600
                                                        @endif
                                                    ">
                                                        {{ ucfirst($cita->estado) }}
                                                    </span>
                                                </span>
                                                <span class="font-semibold">
                                                    Total: <span class="text-indigo-600 text-lg">${{ number_format($cita->total, 2) }}</span>
                                                </span>
                                            </div>

                                            @if($cita->notas)
                                                <div class="mt-2 text-sm text-gray-600">
                                                    <strong>Notas:</strong> {{ $cita->notas }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex flex-col space-y-2 ml-4">
                                            <a href="{{ route('citas.show', $cita) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm text-center">
                                                Ver Detalles
                                            </a>
                                            
                                            @if($cita->estado == 'pendiente')
                                                <a href="{{ route('citas.edit', $cita) }}" 
                                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm text-center">
                                                    Editar
                                                </a>
                                                
                                                <form action="{{ route('citas.destroy', $cita) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('¿Estás seguro de cancelar esta cita?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm w-full">
                                                        Cancelar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Paginación -->
                        <div class="mt-6">
                            {{ $citas->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No tienes citas</h3>
                            <p class="mt-1 text-sm text-gray-500">Comienza reservando tu primera cita.</p>
                            <div class="mt-6">
                                <a href="{{ route('citas.create') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    + Nueva Cita
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>