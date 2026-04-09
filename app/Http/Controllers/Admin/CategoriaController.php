<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Admin\Categoria\UpdateCategoriaRequest;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::latest()->paginate(10);

        return view('admin.categorias.index', [
            'categorias' => $categorias,
            'title' => 'Categorías',
            'header' => 'Categorías',
            'subheader' => 'Listado general de categorías',
        ]);
    }

    public function create()
    {
        return view('admin.categorias.create', [
            'title' => 'Nueva categoría',
            'header' => 'Nueva categoría',
            'subheader' => 'Creá una nueva categoría para tus productos',
        ]);
    }
    public function __construct()
    {
        $this->middleware('permission:categorias.ver')->only('index');
        $this->middleware('permission:categorias.crear')->only(['create', 'store']);
        $this->middleware('permission:categorias.editar')->only(['edit', 'update']);
        $this->middleware('permission:categorias.eliminar')->only('destroy');
    }

    public function store(StoreCategoriaRequest $request)
    {
        Categoria::create([
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'activo' => $request->boolean('activo'),
        ]);

        return redirect()
            ->route('admin.categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', [
            'categoria' => $categoria,
            'title' => 'Editar categoría',
            'header' => 'Editar categoría',
            'subheader' => 'Actualizá la información de la categoría',
        ]);
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update([
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'activo' => $request->boolean('activo'),
        ]);

        return redirect()
            ->route('admin.categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()
            ->route('admin.categorias.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}