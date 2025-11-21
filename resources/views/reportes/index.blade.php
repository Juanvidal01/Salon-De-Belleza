<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Centro de Reportes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Estadísticas rápidas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Clientes</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalClientes }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Citas</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalCitas }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Ingresos Totales</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">
                        ${{ number_format($ingresosTotales, 0) }}
                    </p>
                </div>
            </div>

            {{-- Reportes PDF --}}
            <div class="bg-white shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📄 Reportes PDF</h3>

                    {{-- Reporte de citas por período --}}
                    <div class="border rounded-lg p-4 hover:bg-gray-50">
                        <h4 class="font-semibold text-gray-800 mb-2">
                            📅 Reporte de Citas por Período
                        </h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Genera un reporte detallado de todas las citas en un rango de fechas.
                        </p>

                        <form action="{{ route('admin.reportes.citas.pdf') }}" method="GET"
                              class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha inicio</label>
                                <input type="date" name="fecha_inicio"
                                       value="{{ date('Y-m-01') }}"
                                       required
                                       class="w-full rounded-md border-gray-300 shadow-sm
                                              focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha fin</label>
                                <input type="date" name="fecha_fin"
                                       value="{{ date('Y-m-t') }}"
                                       required
                                       class="w-full rounded-md border-gray-300 shadow-sm
                                              focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div class="flex items-end">
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent
                                               rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-700">
                                    Descargar PDF
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Exportación Excel / CSV --}}
            <div class="bg-white shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📊 Exportación a Excel / CSV</h3>

                    <div class="border rounded-lg p-4 hover:bg-gray-50 flex items-center justify-between">
                        <div>
                            <h4 class="font-semibold text-gray-800">Exportar Citas</h4>
                            <p class="text-sm text-gray-600">
                                Descarga todas las citas registradas en Excel o CSV.
                            </p>
                        </div>
                        <div class="space-x-2">
                            <a href="{{ route('admin.exports.citas.excel') }}"
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                                Excel
                            </a>
                            <a href="{{ route('admin.exports.citas.csv') }}"
                               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm">
                                CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Citas recientes como referencia --}}
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Citas recientes</h3>

                    @if($citasRecientes->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b">
                                        <th class="text-left py-2">Fecha</th>
                                        <th class="text-left py-2">Hora</th>
                                        <th class="text-left py-2">Cliente</th>
                                        <th class="text-left py-2">Estado</th>
                                        <th class="text-right py-2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($citasRecientes as $cita)
                                        <tr class="border-b">
                                            <td class="py-2">
                                                {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                                            </td>
                                            <td class="py-2">{{ $cita->hora }}</td>
                                            <td class="py-2">{{ optional($cita->user)->name }}</td>
                                            <td class="py-2 capitalize">{{ $cita->estado }}</td>
                                            <td class="py-2 text-right">
                                                ${{ number_format($cita->total, 0) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">
                            No hay citas recientes.
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
