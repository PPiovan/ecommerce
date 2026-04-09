@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div class="mb-6 rounded-xl bg-green-100 px-4 py-3 text-green-700">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 rounded-xl bg-red-100 px-4 py-3 text-red-700">
        {{ session('error') }}
    </div>
@endif

<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Usuarios</h3>
            <p class="admin-card-subtitle">Gestioná los usuarios y sus roles</p>
        </div>

        @can('usuarios.crear')
            <a href="{{ route('admin.usuarios.create') }}" class="admin-btn-primary">
                Nuevo usuario
            </a>
        @endcan
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead class="admin-table-head">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">Nro</th>
                    <th class="px-6 py-4 text-left font-semibold">Nombre</th>
                    <th class="px-6 py-4 text-left font-semibold">Email</th>
                    <th class="px-6 py-4 text-left font-semibold">Rol</th>
                    <th class="px-6 py-4 text-left font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $index => $usuario)
                    <tr class="admin-table-row">
                        <td class="px-6 py-4">
                            {{ $usuarios->firstItem() ? $usuarios->firstItem() + $index : $index + 1 }}
                        </td>
                        <td class="px-6 py-4 font-medium">{{ $usuario->name }}</td>
                        <td class="px-6 py-4">{{ $usuario->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                {{ $usuario->getRoleNames()->first() ?? 'Sin rol' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('admin.usuarios.show', $usuario) }}"
                                   class="inline-flex rounded-lg bg-sky-500 px-3 py-2 text-xs font-semibold text-white hover:bg-sky-600">
                                    Ver
                                </a>

                                @can('usuarios.editar')
                                    <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                                       class="admin-btn-edit">
                                        Editar
                                    </a>
                                @endcan

                                @can('usuarios.eliminar')
                                    <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn-delete">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                            No hay usuarios cargados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-slate-200">
        {{ $usuarios->links() }}
    </div>
</div>

@endsection