<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .card {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .service-item {
            padding: 10px;
            border-left: 4px solid #667eea;
            margin: 10px 0;
            background: #f3f4f6;
        }
        .total {
            background: #667eea;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            font-size: 1.5em;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6b7280;
            font-size: 0.9em;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>✨ Salón de Belleza</h1>
        <h2>Confirmación de Cita</h2>
    </div>

    <div class="content">
        <p>Hola <strong>{{ $cita->user->name }}</strong>,</p>
        
        <p>¡Gracias por reservar con nosotros! Tu cita ha sido registrada exitosamente.</p>

        <div class="card">
            <h3>📅 Detalles de tu Cita</h3>
            
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($cita->fecha)->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</p>
            <p><strong>Hora:</strong> {{ date('g:i A', strtotime($cita->hora)) }}</p>
            <p><strong>Estado:</strong> <span style="color: #f59e0b; font-weight: bold;">{{ ucfirst($cita->estado) }}</span></p>
        </div>

        <div class="card">
            <h3>💅 Servicios Contratados</h3>
            
            @foreach($cita->servicios as $servicio)
                <div class="service-item">
                    <strong>{{ $servicio->nombre }}</strong><br>
                    <small>{{ $servicio->duracion_minutos }} minutos</small>
                    <span style="float: right; font-weight: bold; color: #667eea;">
                        ${{ number_format($servicio->pivot->precio, 2) }}
                    </span>
                </div>
            @endforeach
        </div>

        <div class="total">
            <strong>Total a Pagar:</strong> ${{ number_format($cita->total, 2) }}
        </div>

        @if($cita->notas)
            <div class="card">
                <h3>📝 Notas</h3>
                <p>{{ $cita->notas }}</p>
            </div>
        @endif

        <div style="text-align: center;">
            <a href="{{ url('/dashboard') }}" class="button">Ver Mis Citas</a>
        </div>

        <div class="card" style="background: #fef3c7; border-left: 4px solid #f59e0b;">
            <p><strong>ℹ️ Importante:</strong></p>
            <ul>
                <li>Tu cita está <strong>pendiente de confirmación</strong></li>
                <li>Recibirás otro email cuando sea confirmada</li>
                <li>Por favor llega 5 minutos antes de tu cita</li>
                <li>Para cancelar o modificar, visita tu panel de citas</li>
            </ul>
        </div>
    </div>

    <div class="footer">
        <p>Este es un email automático, por favor no respondas a este mensaje.</p>
        <p>&copy; {{ date('Y') }} Salón de Belleza. Todos los derechos reservados.</p>
    </div>
</body>
</html>