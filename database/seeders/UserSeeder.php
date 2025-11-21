<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario Administrador
        User::create([
            'name' => 'Admin Salón',
            'email' => 'admin@salon.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'activo' => true,
            'email_verified_at' => now()
        ]);

        // Usuario Empleado
        User::create([
            'name' => 'María Estilista',
            'email' => 'maria@salon.com',
            'password' => Hash::make('empleado123'),
            'role' => 'empleado',
            'activo' => true,
            'email_verified_at' => now()
        ]);

        // Usuarios Cliente de prueba
        User::create([
            'name' => 'Juan Cliente',
            'email' => 'juan@cliente.com',
            'password' => Hash::make('cliente123'),
            'role' => 'cliente',
            'activo' => true,
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Ana García',
            'email' => 'ana@cliente.com',
            'password' => Hash::make('cliente123'),
            'role' => 'cliente',
            'activo' => true,
            'email_verified_at' => now()
        ]);
    }
}