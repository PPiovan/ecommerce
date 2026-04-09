@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div class="mb-6 admin-badge-success px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
@endif
@php use Illuminate\Support\Str; @endphp

<div class="space-y-6">

    <div class="border-b border-slate-200 pb-4 dark:border-slate-800">
        <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100">
            Permisos del rol {{ $rol->name }}
        </h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            Definí rápidamente qué puede ver y qué puede hacer este rol dentro del panel.
        </p>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3 class="admin-card-title">Permisos registrados</h3>
                <p class="admin-card-subtitle">
                    Organizamos los accesos por módulo para que sea más fácil administrarlos.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="button" onclick="marcarTodos()" class="admin-btn-secondary">
                    Marcar todo
                </button>

                <button type="button" onclick="desmarcarTodos()" class="admin-btn-secondary">
                    Desmarcar todo
                </button>
            </div>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.roles.actualizar-permisos', $rol) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @forelse($permisosAgrupados as $modulo => $permisos)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900/60">

                            <div class="flex items-center justify-between gap-3 mb-4">
                                <h4 class="text-lg font-bold text-slate-800 dark:text-slate-100">
                                    {{ $modulo }}
                                </h4>

                                <label class="flex items-center gap-2 text-xs font-medium text-slate-500 dark:text-slate-400">
                                    <input
                                        type="checkbox"
                                        class="admin-checkbox modulo-checkbox"
                                        data-modulo="{{ Str::slug($modulo) }}"
                                        onchange="toggleModulo('{{ Str::slug($modulo) }}', this.checked)"
                                    >
                                    Todo
                                </label>
                            </div>

                            <div class="space-y-3">
                                @foreach($permisos as $permiso)
                                    <label class="flex items-start gap-3">
                                        <input
                                            type="checkbox"
                                            name="permisos[]"
                                            value="{{ $permiso->name }}"
                                            class="admin-checkbox permiso-checkbox modulo-{{ Str::slug($modulo) }} mt-1"
                                            {{ $rol->hasPermissionTo($permiso->name) ? 'checked' : '' }}
                                        >

                                        <span class="text-sm text-slate-700 dark:text-slate-300 leading-5">
                                            {{ $permiso->descripcion ?? ucfirst(str_replace(['.', '-'], ' ', $permiso->name)) }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>

                        </div>
                    @empty
                        <div class="md:col-span-2 xl:col-span-3">
                            <p class="text-center text-slate-500 dark:text-slate-400">
                                No hay permisos cargados todavía.
                            </p>
                        </div>
                    @endforelse

                </div>

                <div class="admin-form-actions pt-4 border-t border-slate-200 dark:border-slate-800">
                    <a href="{{ route('admin.roles.index') }}" class="admin-btn-secondary">
                        Volver
                    </a>

                    <button type="submit" class="admin-btn-primary">
                        Guardar permisos
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function marcarTodos() {
        document.querySelectorAll('.permiso-checkbox').forEach(el => el.checked = true);
        actualizarChecksModulo();
    }

    function desmarcarTodos() {
        document.querySelectorAll('.permiso-checkbox').forEach(el => el.checked = false);
        actualizarChecksModulo();
    }

    function toggleModulo(modulo, checked) {
        document.querySelectorAll('.modulo-' + modulo).forEach(el => el.checked = checked);
    }

    function actualizarChecksModulo() {
        document.querySelectorAll('.modulo-checkbox').forEach(checkModulo => {
            const modulo = checkModulo.dataset.modulo;
            const items = document.querySelectorAll('.modulo-' + modulo);

            if (!items.length) return;

            const todosMarcados = [...items].every(item => item.checked);
            checkModulo.checked = todosMarcados;
        });
    }

    document.addEventListener('DOMContentLoaded', actualizarChecksModulo);
</script>

@endsection