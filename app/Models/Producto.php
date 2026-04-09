<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'oferta_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }

    public function ofertaActiva()
    {
        return $this->hasOne(\App\Models\Oferta::class, 'producto_id')
            ->where('activa', 1);
    }

    public function getImagenUrlAttribute()
    {
        if (!$this->imagen) {
            return 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop';
        }

        return asset('storage/' . $this->imagen);
    }

    public function getTieneOfertaAttribute()
    {
        return $this->ofertaActiva !== null;
    }

    public function getPrecioFinalAttribute()
    {
        $precio = (float) $this->precio;

        if (!$this->tiene_oferta) {
            return $precio;
        }

        if ($this->ofertaActiva->tipo === 'porcentaje') {
            return max(0, $precio - ($precio * ((float) $this->ofertaActiva->valor / 100)));
        }

        if ($this->ofertaActiva->tipo === 'monto_fijo') {
            return max(0, $precio - (float) $this->ofertaActiva->valor);
        }

        return $precio;
    }

    public function getDescuentoLabelAttribute()
    {
        if (!$this->tiene_oferta) {
            return null;
        }

        if ($this->ofertaActiva->tipo === 'porcentaje') {
            return '-' . (int) $this->ofertaActiva->valor . '%';
        }

        if ($this->ofertaActiva->tipo === 'monto_fijo') {
            return '-$' . number_format((float) $this->ofertaActiva->valor, 0, ',', '.');
        }

        return 'Oferta';
    }

    public function detallesVenta(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'producto_id');
    }
}