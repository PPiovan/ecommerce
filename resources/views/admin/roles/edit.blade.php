@extends('layouts.admin')

@section('content')
<div class="max-w-2xl">

    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Editar rol</h3>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.roles.update', $rol) }}" method="POST" class="admin-form">
                @csrf
                @method('PUT')

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
                            value="{{ old('name', $rol->name) }}"
                            placeholder="Nombre del rol"
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
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection