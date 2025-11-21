<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Horario - ') }} {{ ucfirst($horario->dia_semana) }}
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

                    <form method="POST" action="{{ route('admin.horarios.update', $horario) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Día de la Semana
                            </label>
                            <input type="text" 
                                   value="{{ ucfirst($horario->dia_semana) }}"
                                   class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed"
                                   disabled>
                            <p class="text-sm text-gray-500 mt-1">El día no se puede modificar</p>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="hora_inicio" class="block text-sm font-medium text-gray-700 mb-2">
                                    Hora de Inicio <span class="text-red-500">*</span>
                                </label>
                                <input type="time" 
                                       name="hora_inicio" 
                                       id="hora_inicio" 
                                       value="{{ old('hora_inicio', $horario->hora_inicio) }}"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                            </div>

                            <div>
                                <label for="hora_fin" class="block text-sm font-medium text-gray-700 mb-2">
                                    Hora de Cierre <span class="text-red-500">*</span>
                                </label>
                                <input type="time" 
                                       name="hora_fin" 
                                       id="hora_fin" 
                                       value="{{ old('hora_fin', $horario->hora_fin) }}"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="intervalo_minutos" class="block text-sm font-medium text-gray-700 mb-2">
                                Intervalo entre Citas (minutos) <span class="text-red-500">*</span>
                            </label>
                            <select name="intervalo_minutos" 
                                    id="intervalo_minutos" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                <option value="15" {{ old('intervalo_minutos', $horario->intervalo_minutos) == '15' ? 'selected' : '' }}>15 minutos</option>
                                <option value="30" {{ old('intervalo_minutos', $horario->intervalo_minutos) == '30' ? 'selected' : '' }}>30 minutos</option>
                                <option value="45" {{ old('intervalo_minutos', $horario->intervalo_minutos) == '45' ? 'selected' : '' }}>45 minutos</option>
                                <option value="60" {{ old('intervalo_minutos', $horario->intervalo_minutos) == '60' ? 'selected' : '' }}>60 minutos</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="activo" 
                                       value="1"
                                       {{ old('activo', $horario->activo) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Horario Activo</span>
                            </label>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t">
                            <a href="{{ route('admin.horarios.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg">
                                Cancelar
                            </a>
                            
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">
                                Actualizar Horario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>