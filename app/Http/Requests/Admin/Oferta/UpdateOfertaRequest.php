<?php

namespace App\Http\Requests\Admin\Oferta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfertaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|in:porcentaje,monto_fijo',
            'valor' => 'required|numeric|min:0',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'activa' => 'nullable|boolean',
        ];
    }
}