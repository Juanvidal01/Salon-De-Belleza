<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Servicio extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'duracion_minutos',
        'activo'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'duracion_minutos' => 'integer',
        'activo' => 'boolean'
    ];

    /**
     * Relación muchos a muchos con Cita
     */
    public function citas(): BelongsToMany
    {
        return $this->belongsToMany(Cita::class, 'cita_servicio')
                    ->withPivot('precio')
                    ->withTimestamps();
    }
}