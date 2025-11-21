<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.servicios.store') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre del Servicio <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="nombre" 
                                   id="nombre" 
                                   value="{{ old('nombre') }}"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   placeholder="Ej: Corte de Cabello"
                                   required>
                        </div>

                        <div class="mb-6">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                                Descripción
                            </label>
                            <textarea name="descripcion" 
                                      id="descripcion" 
                                      rows="3"
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="Descripción del servicio...">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">
                                    Precio <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                                    <input type="number" 
                                           name="precio" 
                                           id="precio" 
                                           value="{{ old('precio') }}"
                                           step="0.01"
                                           min="0"
                                           class="w-full pl-7 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           placeholder="0.00"
                                           required>
                                </div>
                            </div>

                            <div>
                                <label for="duracion_minutos" class="block text-sm font-medium text-gray-700 mb-2">
                                    Duración (minutos) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="duracion_minutos" 
                                       id="duracion_minutos" 
                                       value="{{ old('duracion_minutos', 30) }}"
                                       min="15"
                                       step="15"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                                <p class="text-sm text-gray-500 mt-1">Mínimo 15 minutos</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="activo" 
                                       value="1"
                                       {{ old('activo', true) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Servicio Activo (disponible para reservar)</span>
                            </label>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t">
                            <a href="{{ route('admin.servicios.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg">
                                Cancelar
                            </a>
                            
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">
                                Crear Servicio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>