@extends('layouts.admin')

@section('content')
<div class="max-w-3xl">

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3 class="admin-card-title">Detalle del rol</h3>
                <p class="admin-card-subtitle">Información general del rol y sus permisos asignados</p>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Nombre</p>
                    <p class="mt-1 text-lg font-semibold text-slate-800">
                        {{ $rol->name }}
                    </p>
                </div>

                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Cantidad de permisos</p>
                    <p class="mt-1 text-lg font-semibold text-slate-800">
                        {{ $rol->permissions->count() }}
                    </p>
                </div>
            </div>

            <div>
                <h4 class="mb-3 text-sm font-semibold uppercase tracking-wide text-slate-500">
                    Permisos asignados
                </h4>

                @if($rol->permissions->count())
                    <div class="flex flex-wrap gap-2">
                        @foreach($rol->permissions as $permiso)
                            <span class="inline-flex rounded-full bg-blue-100 text-blue-700 px-3 py-1 text-xs font-semibold">
                                {{ $permiso->name }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-slate-500">
                        Este rol todavía no tiene permisos asignados.
                    </p>
                @endif
            </div>

            <div class="admin-form-actions">
                <a href="{{ route('admin.roles.index') }}" class="admin-btn-secondary">
                    Volver
                </a>

                <a href="{{ route('admin.roles.permisos', $rol) }}" class="admin-btn-primary">
                    Gestionar permisos
                </a>
            </div>
        </div>
    </div>

</div>
@endsection