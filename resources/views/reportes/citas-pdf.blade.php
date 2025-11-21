<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 20px; }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #4F46E5;
            padding-bottom: 10px;
        }
        .header h1 { margin: 0; color: #4F46E5; }
        .info-box {
            background: #F3F4F6;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .info-box table { width: 100%; }
        .info-box td { padding: 3px 0; }
        .label { font-weight: bold; color: #374151; width: 25%; }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data th {
            background: #4F46E5;
            color: #fff;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        table.data td {
            padding: 6px 8px;
            border-bottom: 1px solid #E5E7EB;
        }
        table.data tr:nth-child(even) { background: #F9FAFB; }
        .text-right { text-align: right; }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #6B7280;
            border-top: 1px solid #E5E7EB;
            padding-top: 8px;
        }
        .total-box {
            margin-top: 10px;
            background: #EEF2FF;
            padding: 10px 15px;
            border-radius: 4px;
            text-align: right;
            color: #4F46E5;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $titulo }}</h1>
        <div>Salón de Belleza - Sistema de Citas</div>
    </div>

    <div class="info-box">
        <table>
            <tr>
                <td class="label">Fecha de generación:</td>
                <td>{{ $fecha }}</td>
                <td class="label">Rango de fechas:</td>
                <td>
                    {{ $fechaInicio ?? 'N/A' }} - {{ $fechaFin ?? 'N/A' }}
                </td>
            </tr>
            <tr>
                <td class="label">Total citas:</td>
                <td>{{ $totalCitas }}</td>
                <td class="label">Total ingresos:</td>
                <td>${{ number_format($totalIngresos, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th style="width: 8%;">ID</th>
                <th style="width: 15%;">Fecha</th>
                <th style="width: 12%;">Hora</th>
                <th style="width: 25%;">Cliente</th>
                <th style="width: 15%;">Estado</th>
                <th style="width: 15%;" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>{{ optional($cita->user)->name }}</td>
                    <td>{{ ucfirst($cita->estado) }}</td>
                    <td class="text-right">
                        ${{ number_format($cita->total, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-right">
                        No hay citas en el rango seleccionado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-box">
        Total de citas en este reporte: {{ $totalCitas }} | Ingresos: ${{ number_format($totalIngresos, 0, ',', '.') }}
    </div>

    <div class="footer">
        Reporte generado automáticamente - {{ date('Y') }}
    </div>
</body>
</html>
