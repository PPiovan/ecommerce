<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'user_id',
        'fecha',
        'estado',
        'subtotal',
        'total',
        'metodo_pago',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public const ESTADO_PENDIENTE = 'pendiente';
    public const ESTADO_PAGADA = 'pagada';
    public const ESTADO_PREPARANDO = 'preparando';
    public const ESTADO_ENVIADA = 'enviada';
    public const ESTADO_ENTREGADA = 'entregada';
    public const ESTADO_CANCELADA = 'cancelada';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }

    public function getCantidadItemsAttribute(): int
    {
        return $this->detalles->sum('cantidad');
    }

    public function getEstadoLabelAttribute(): string
    {
        return match ($this->estado) {
            self::ESTADO_PAGADA => 'Pagada',
            self::ESTADO_PREPARANDO => 'Preparando',
            self::ESTADO_ENVIADA => 'Enviada',
            self::ESTADO_ENTREGADA => 'Entregada',
            self::ESTADO_CANCELADA => 'Cancelada',
            default => 'Pendiente',
        };
    }

    public function getEstadoBadgeClassesAttribute(): string
    {
        return match ($this->estado) {
            self::ESTADO_PAGADA, self::ESTADO_ENTREGADA => 'border-emerald-200 bg-emerald-50 text-emerald-700',
            self::ESTADO_ENVIADA => 'border-sky-200 bg-sky-50 text-sky-700',
            self::ESTADO_PREPARANDO => 'border-violet-200 bg-violet-50 text-violet-700',
            self::ESTADO_CANCELADA => 'border-rose-200 bg-rose-50 text-rose-700',
            default => 'border-amber-200 bg-amber-50 text-amber-700',
        };
    }

    public function getPasoSeguimientoAttribute(): int
    {
        return match ($this->estado) {
            self::ESTADO_PENDIENTE => 1,
            self::ESTADO_PAGADA => 2,
            self::ESTADO_PREPARANDO => 3,
            self::ESTADO_ENVIADA => 4,
            self::ESTADO_ENTREGADA => 5,
            self::ESTADO_CANCELADA => 0,
            default => 1,
        };
    }

    public function getTimelineAttribute(): array
    {
        return [
            1 => 'Pedido realizado',
            2 => 'Pago confirmado',
            3 => 'Preparando pedido',
            4 => 'En camino',
            5 => 'Entregado',
        ];
    }
}