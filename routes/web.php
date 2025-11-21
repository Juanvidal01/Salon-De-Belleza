<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\HorarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ExportController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Servicios (público para todos los usuarios autenticados)
    Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
    Route::get('/servicios/{servicio}', [ServicioController::class, 'show'])->name('servicios.show');

    // Citas (para clientes)
    Route::resource('citas', CitaController::class);
    
    // API para horarios disponibles
    Route::get('/api/horarios-disponibles', [CitaController::class, 'horariosDisponibles'])->name('api.horarios-disponibles');

    // Rutas de Administración (solo admin y empleados)
    Route::middleware(['role:admin,empleado'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/citas', [CitaController::class, 'adminIndex'])->name('citas.index');
        Route::post('/citas/{cita}/cambiar-estado', [CitaController::class, 'cambiarEstado'])->name('citas.cambiar-estado');
    });

    // Rutas solo para Admin
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        // Servicios
    Route::get('/servicios', [ServicioController::class, 'admin'])->name('servicios.index');
  // Servicios (CRUD)
        Route::get('/servicios', [ServicioController::class, 'admin'])->name('servicios.index');
        Route::get('/servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
        Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');
        Route::get('/servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
        Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
        Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');

        // Activar / Desactivar
        Route::post('/servicios/{servicio}/toggle', [ServicioController::class, 'toggle'])->name('servicios.toggle');
    // 🔹 Página principal de reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');

    // PDF de citas
    Route::get('reportes/citas-pdf', [ReporteController::class, 'citasPDF'])->name('reportes.citas.pdf');

    // Exportaciones de citas
    Route::get('exports/citas/excel', [ExportController::class, 'citasExcel'])->name('exports.citas.excel');
    Route::get('exports/citas/csv', [ExportController::class, 'citasCSV'])->name('exports.citas.csv');

    // Usuarios
    Route::resource('usuarios', UsuarioController::class);
    Route::post('/usuarios/{usuario}/toggle', [UsuarioController::class, 'toggleActivo'])->name('usuarios.toggle');

    // Horarios
    Route::resource('horarios', HorarioController::class);
    Route::post('/horarios/{horario}/toggle', [HorarioController::class, 'toggle'])->name('horarios.toggle');
});
});

require __DIR__.'/auth.php';