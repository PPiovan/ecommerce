@extends('layouts.admin')

@section('content')
<div class="max-w-3xl">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Detalle del usuario</h3>
        </div>

        <div class="p-6 space-y-4">
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm text-slate-500">Nombre</p>
                <p class="mt-1 font-semibold text-slate-800">{{ $usuario->name }}</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm text-slate-500">Email</p>
                <p class="mt-1 font-semibold text-slate-800">{{ $usuario->email }}</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm text-slate-500">Rol</p>
                <p class="mt-1 font-semibold text-slate-800">
                    {{ $usuario->getRoleNames()->first() ?? 'Sin rol' }}
                </p>
            </div>

            <div class="admin-form-actions">
                <a href="{{ route('admin.usuarios.index') }}" class="admin-btn-secondary">Volver</a>
                <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="admin-btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection