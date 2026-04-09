@extends('layouts.admin')

@section('content')

@if(session('success'))
<div class="mb-6 admin-badge-success px-4 py-3 rounded-xl">
    {{ session('success') }}
</div>
@endif

<div class="admin-card">

    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Listado de categorías</h3>
            <p class="admin-card-subtitle">Administrá las categorías del sistema</p>
        </div>

        <a href="{{ route('admin.categorias.create') }}" class="admin-btn-primary">
            Nueva categoría
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">

            <thead class="admin-table-head">
                <tr>
                    <th class="text-left px-6 py-4 font-semibold">ID</th>
                    <th class="text-left px-6 py-4 font-semibold">Nombre</th>
                    <th class="text-left px-6 py-4 font-semibold">Slug</th>
                    <th class="text-left px-6 py-4 font-semibold">Estado</th>
                    <th class="text-left px-6 py-4 font-semibold">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categorias as $categoria)

                <tr class="admin-table-row">

                    <td class="px-6 py-4">{{ $categoria->id }}</td>

                    <td class="px-6 py-4 font-medium">
                        {{ $categoria->nombre }}
                    </td>

                    <td class="px-6 py-4 text-slate-500">
                        {{ $categoria->slug }}
                    </td>

                    <td class="px-6 py-4">
                        @if($categoria->activo)
                            <span class="admin-badge-success">Activa</span>
                        @else
                            <span class="admin-badge-danger">Inactiva</span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">

                            <a href="{{ route('admin.categorias.edit', $categoria) }}"
                               class="admin-btn-edit">
                                Editar
                            </a>

                            <form action="{{ route('admin.categorias.destroy', $categoria) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Eliminar esta categoría?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="admin-btn-delete">
                                    Eliminar
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                        No hay categorías cargadas todavía.
                    </td>
                </tr>

                @endforelse
            </tbody>

        </table>
    </div>

    <div class="px-6 py-4 border-t border-slate-200">
        {{ $categorias->links() }}
    </div>

</div>

@endsection