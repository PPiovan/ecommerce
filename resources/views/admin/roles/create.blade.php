@extends('layouts.admin')

@section('content')
<div class="max-w-2xl">

    <div class="admin-card">

        <div class="admin-card-header">
            <h3 class="admin-card-title">
                Crear nuevo rol
            </h3>
        </div>

        <div class="p-6">

            <div class="mb-6 rounded-xl bg-slate-50 border border-slate-200 px-4 py-3">
                <p class="admin-card-subtitle">
                    Completá los datos para registrar un nuevo rol en el sistema
                </p>
            </div>

            <form action="{{ route('admin.roles.store') }}" method="POST" class="admin-form">
                @csrf

                <div class="admin-form-group">
                    <label for="name" class="admin-label">
                        Nombre del rol (*)
                    </label>

                    <div class="admin-input-icon-wrap">
                        <span class="admin-input-icon">🛡️</span>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Ej: VENDEDOR, OPERADOR, ADMINISTRADOR"
                            class="admin-input admin-input-with-icon"
                        >
                    </div>

                    @error('name')
                        <p class="admin-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="admin-form-actions">
                    <a href="{{ route('admin.roles.index') }}" class="admin-btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="admin-btn-primary">
                        Registrar
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>
@endsection