<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventarioMovimiento extends Model
{
    use HasFactory;

    protected $table = 'inventario_movimientos';

    protected $fillable = [
        'producto_id',
        'tipo',
        'cantidad',
        'motivo',
        'detalle',
        'user_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}