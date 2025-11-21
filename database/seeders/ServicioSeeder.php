<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            [
                'nombre' => 'Corte de Cabello Mujer',
                'descripcion' => 'Corte personalizado para dama con lavado incluido',
                'precio' => 90.00,
                'duracion_minutos' => 45,
                'activo' => true
            ],
            [
                'nombre' => 'Corte de Cabello Hombre',
                'descripcion' => 'Corte clásico o moderno con lavado',
                'precio' => 80.00,
                'duracion_minutos' => 30,
                'activo' => true
            ],
            [
                'nombre' => 'Peinado Mujer',
                'descripcion' => 'Peinado profesional para eventos',
                'precio' => 150.00,
                'duracion_minutos' => 60,
                'activo' => true
            ],
            [
                'nombre' => 'Peinado Hombre',
                'descripcion' => 'Peinado formal o casual',
                'precio' => 60.00,
                'duracion_minutos' => 30,
                'activo' => true
            ],
            [
                'nombre' => 'Corte de Barba',
                'descripcion' => 'Recorte y perfilado de barba',
                'precio' => 60.00,
                'duracion_minutos' => 20,
                'activo' => true
            ],
            [
                'nombre' => 'Tinte Completo',
                'descripcion' => 'Aplicación de tinte en todo el cabello',
                'precio' => 300.00,
                'duracion_minutos' => 120,
                'activo' => true
            ],
            [
                'nombre' => 'Manicure',
                'descripcion' => 'Manicure completo con esmaltado',
                'precio' => 200.00,
                'duracion_minutos' => 45,
                'activo' => true
            ],
            [
                'nombre' => 'Pedicure',
                'descripcion' => 'Pedicure completo con esmaltado',
                'precio' => 250.00,
                'duracion_minutos' => 60,
                'activo' => true
            ],
            [
                'nombre' => 'Lavado de Cabello',
                'descripcion' => 'Lavado profundo con masaje capilar',
                'precio' => 50.00,
                'duracion_minutos' => 15,
                'activo' => true
            ],
            [
                'nombre' => 'Tratamiento Capilar',
                'descripcion' => 'Tratamiento hidratante y reparador',
                'precio' => 200.00,
                'duracion_minutos' => 45,
                'activo' => true
            ],
            [
                'nombre' => 'Maquillaje Social',
                'descripcion' => 'Maquillaje profesional para eventos',
                'precio' => 350.00,
                'duracion_minutos' => 60,
                'activo' => true
            ],
            [
                'nombre' => 'Depilación Facial',
                'descripcion' => 'Depilación de cejas y labio superior',
                'precio' => 100.00,
                'duracion_minutos' => 30,
                'activo' => true
            ]
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}