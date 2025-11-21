<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Editando: {{ $servicio->nombre }}
                </h3>

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.servicios.update', $servicio) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $servicio->nombre) }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                            <input type="number" name="precio" min="0" step="0.01"
                                   value="{{ old('precio', $servicio->precio) }}"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Duración (minutos)</label>
                            <input type="number" name="duracion_minutos" min="15" step="5"
                                   value="{{ old('duracion_minutos', $servicio->duracion_minutos) }}"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="flex items-center mt-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="activo" value="1"
                                       {{ old('activo', $servicio->activo) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Activo</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('admin.servicios.index') }}"
                           class="px-4 py-2 rounded-md border border-gray-300 text-sm text-gray-700 hover:bg-gray-100">
                            Volver
                        </a>
                        <button type="submit"
                                class="px-4 py-2 rounded-md bg-indigo-600 text-sm font-semibold text-white hover:bg-indigo-700">
                            Actualizar servicio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
