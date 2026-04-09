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
            <h3 class="admin-card-title">Listado de roles</h3>
            <p class="admin-card-subtitle">Administrá los roles y sus permisos dentro del sistema</p>
        </div>

        <a href="{{ route('admin.roles.create') }}" class="admin-btn-primary">
            Nuevo rol
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">

            <thead class="admin-table-head">
                <tr>
                    <th class="text-left px-6 py-4 font-semibold">Nro</th>
                    <th class="text-left px-6 py-4 font-semibold">Nombre del rol</th>
                    <th class="text-left px-6 py-4 font-semibold">Cantidad de permisos</th>
                    <th class="text-left px-6 py-4 font-semibold">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($roles as $index => $rol)
                    <tr class="admin-table-row">
                        <td class="px-6 py-4">
                            {{ $roles->firstItem() ? $roles->firstItem() + $index : $index + 1 }}
                        </td>

                        <td class="px-6 py-4 font-medium">
                            {{ $rol->name }}
                        </td>

                        <td class="px-6 py-4 text-slate-500">
                            {{ $rol->permissions->count() }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-wrap items-center gap-2">
                                <a href="{{ route('admin.roles.show', $rol) }}"
                                   class="inline-flex items-center rounded-lg bg-sky-500 px-3 py-2 text-xs font-semibold text-white transition hover:bg-sky-600">
                                    Ver
                                </a>

                                <a href="{{ route('admin.roles.permisos', $rol) }}"
                                   class="inline-flex items-center rounded-lg bg-amber-400 px-3 py-2 text-xs font-semibold text-slate-900 transition hover:bg-amber-500">
                                    Permisos
                                </a>

                                <a href="{{ route('admin.roles.edit', $rol) }}"
                                   class="admin-btn-edit">
                                    Editar
                                </a>

                                @if($rol->name !== 'SUPER ADMIN')
                                    <form action="{{ route('admin.roles.destroy', $rol) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar este rol?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="admin-btn-delete">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                            No hay roles cargados todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="px-6 py-4 border-t border-slate-200">
        {{ $roles->links() }}
    </div>

</div>

@endsection