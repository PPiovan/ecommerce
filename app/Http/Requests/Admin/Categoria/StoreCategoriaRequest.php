<?php

namespace App\Http\Requests\Admin\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
            'slug' => 'required|string|max:120|unique:categorias,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'descripcion' => 'nullable|string|max:1000',
            'activo' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Ya existe una categoría con ese nombre.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.unique' => 'Ese slug ya está en uso.',
            'slug.regex' => 'El slug solo puede contener letras minúsculas, números y guiones.',
        ];
    }
}