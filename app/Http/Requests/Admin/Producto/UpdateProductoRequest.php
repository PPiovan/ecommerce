<?php

namespace App\Http\Requests\Admin\Producto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productoId = $this->route('producto')->id;

        return [
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:150|unique:productos,nombre,' . $productoId,
            'slug' => 'required|string|max:180|unique:productos,slug,' . $productoId . '|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'descripcion' => 'nullable|string|max:2000',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'activo' => 'nullable|boolean',
            'destacado' => 'nullable|boolean',
        ];
    }
}