<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensajes de éxito --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">
                    Lista de servicios
                </h3>

                <a href="{{ route('admin.servicios.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent 
                          rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                          hover:bg-indigo-700">
                    + Nuevo servicio
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                @if($servicios->count())
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="px-4 py-2 text-left font-semibold text-gray-700">Nombre</th>
                                <th class="px-4 py-2 text-left font-semibold text-gray-700">Descripción</th>
                                <th class="px-4 py-2 text-right font-semibold text-gray-700">Precio</th>
                                <th class="px-4 py-2 text-center font-semibold text-gray-700">Duración</th>
                                <th class="px-4 py-2 text-center font-semibold text-gray-700">Estado</th>
                                <th class="px-4 py-2 text-right font-semibold text-gray-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($servicios as $servicio)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">
                                        <span class="font-semibold text-gray-800">
                                            {{ $servicio->nombre }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-gray-600">
                                        {{ Str::limit($servicio->descripcion, 60) }}
                                    </td>
                                    <td class="px-4 py-2 text-right">
                                        ${{ number_format($servicio->precio, 0) }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        {{ $servicio->duracion_minutos }} min
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        @if($servicio->activo)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                Activo
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                                Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-right space-x-2">
                                        {{-- Toggle activo --}}
                                        <form action="{{ route('admin.servicios.toggle', $servicio) }}" 
                                              method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 rounded text-xs
                                                       {{ $servicio->activo ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                                                {{ $servicio->activo ? 'Desactivar' : 'Activar' }}
                                            </button>
                                        </form>

                                        {{-- Editar --}}
                                        <a href="{{ route('admin.servicios.edit', $servicio) }}"
                                           class="inline-flex items-center px-3 py-1 rounded text-xs bg-blue-100 text-blue-800 hover:bg-blue-200">
                                            Editar
                                        </a>

                                        {{-- Eliminar --}}
                                        <form action="{{ route('admin.servicios.destroy', $servicio) }}" 
                                              method="POST" class="inline"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar este servicio?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 rounded text-xs bg-red-100 text-red-800 hover:bg-red-200">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="p-6 text-center text-gray-500">
                        No hay servicios registrados. Crea el primero con el botón “Nuevo servicio”.
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
