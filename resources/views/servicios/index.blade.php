<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuestros Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg p-8 mb-8 text-white">
                <h2 class="text-3xl font-bold mb-2">✨ Salón de Belleza</h2>
                <p class="text-indigo-100">Descubre todos nuestros servicios profesionales de belleza</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($servicios as $servicio)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $servicio->nombre }}</h3>
                            <p class="text-gray-600 text-sm mb-4 h-12">{{ $servicio->descripcion }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-sm text-gray-500">Precio</p>
                                    <p class="text-2xl font-bold text-indigo-600">${{ number_format($servicio->precio, 2) }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Duración</p>
                                    <p class="text-lg font-semibold text-gray-700">{{ $servicio->duracion_minutos }} min</p>
                                </div>
                            </div>

                            <a href="{{ route('citas.create') }}" 
                               class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white text-center py-3 rounded-lg font-semibold transition">
                                Reservar Ahora
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($servicios->count() === 0)
                <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No hay servicios disponibles</h3>
                    <p class="text-gray-600">Por favor, vuelve más tarde</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>