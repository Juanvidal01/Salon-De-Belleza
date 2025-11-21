<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDisponible extends Model
{
    protected $table = 'horario_disponibles'; 

    protected $fillable = [
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'intervalo_minutos',
        'activo'
    ];

    protected $casts = [
        'intervalo_minutos' => 'integer',
        'activo' => 'boolean'
    ];

    public function generarHorarios(): array
    {
        $horarios = [];
        $inicio = \Carbon\Carbon::parse($this->hora_inicio);
        $fin = \Carbon\Carbon::parse($this->hora_fin);

        while ($inicio->lessThan($fin)) {
            $horarios[] = $inicio->format('H:i');
            $inicio->addMinutes($this->intervalo_minutos);
        }

        return $horarios;
    }
}