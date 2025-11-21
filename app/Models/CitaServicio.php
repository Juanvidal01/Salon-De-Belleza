<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CitaServicio extends Model
{
    protected $table = 'cita_servicio';

    protected $fillable = [
        'cita_id',
        'servicio_id',
        'precio'
    ];

    protected $casts = [
        'precio' => 'decimal:2'
    ];

    /**
     * Relación con Cita
     */
    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }

    /**
     * Relación con Servicio
     */
    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class);
    }
}