<?php

namespace App\Http\Requests\Admin\Inventario;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioMovimientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|in:ingreso,egreso,ajuste',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'nullable|string|max:255',
            'detalle' => 'nullable|string|max:1000',
        ];
    }
}