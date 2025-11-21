<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cita extends Model
{
    protected $fillable = [
        'user_id',
        'fecha',
        'hora',
        'total',
        'estado',
        'notas'
    ];

    protected $casts = [
        'fecha' => 'date',
        'total' => 'decimal:2'
    ];

    /**
     * Relación con User (Cliente)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación muchos a muchos con Servicio
     */
    public function servicios(): BelongsToMany
    {
        return $this->belongsToMany(Servicio::class, 'cita_servicio')
                    ->withPivot('precio')
                    ->withTimestamps();
    }

    /**
     * Scope para filtrar por estado
     */
    public function scopeEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    /**
     * Scope para filtrar por fecha
     */
    public function scopeFecha($query, $fecha)
    {
        return $query->whereDate('fecha', $fecha);
    }

    /**
     * Obtener citas del día
     */
    public function scopeHoy($query)
    {
        return $query->whereDate('fecha', today());
    }
}