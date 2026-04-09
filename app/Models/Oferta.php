<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oferta extends Model
{
    use HasFactory;

    protected $table = 'ofertas';

    protected $fillable = [
        'producto_id',
        'tipo',
        'valor',
        'fecha_inicio',
        'fecha_fin',
        'activa',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activa' => 'boolean',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function estaVigente(): bool
    {
        if (!$this->activa) {
            return false;
        }

        $hoy = now()->startOfDay();

        if ($this->fecha_inicio && $hoy->lt($this->fecha_inicio)) {
            return false;
        }

        if ($this->fecha_fin && $hoy->gt($this->fecha_fin)) {
            return false;
        }

        return true;
    }
}