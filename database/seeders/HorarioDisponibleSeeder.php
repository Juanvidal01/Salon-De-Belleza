<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HorarioDisponible;

class HorarioDisponibleSeeder extends Seeder
{
    public function run(): void
    {
        // Horarios de lunes a viernes
        foreach (['lunes', 'martes', 'miercoles', 'jueves', 'viernes'] as $dia) {
            HorarioDisponible::create([
                'dia_semana' => $dia,
                'hora_inicio' => '09:00:00',
                'hora_fin' => '19:00:00',
                'intervalo_minutos' => 30,
                'activo' => true
            ]);
        }
        
        // Horario de sábado (más corto)
        HorarioDisponible::create([
            'dia_semana' => 'sabado',
            'hora_inicio' => '09:00:00',
            'hora_fin' => '14:00:00',
            'intervalo_minutos' => 30,
            'activo' => true
        ]);
    }
}