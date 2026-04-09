@extends('layouts.admin')

@section('content')
<div class="max-w-2xl">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Crear usuario</h3>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.usuarios.store') }}" method="POST" class="admin-form">
                @csrf

                <div class="admin-form-group">
                    <label class="admin-label">Nombre</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="admin-input">
                    @error('name') <p class="admin-error">{{ $message }}</p> @enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="admin-input">
                    @error('email') <p class="admin-error">{{ $message }}</p> @enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-label">Contraseña</label>
                    <input type="password" name="password" class="admin-input">
                    @error('password') <p class="admin-error">{{ $message }}</p> @enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-label">Rol</label>
                    <select name="rol" class="admin-input">
                        <option value="">Seleccionar rol</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->name }}" {{ old('rol') === $rol->name ? 'selected' : '' }}>
                                {{ $rol->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('rol') <p class="admin-error">{{ $message }}</p> @enderror
                </div>

                <div class="admin-form-actions">
                    <a href="{{ route('admin.usuarios.index') }}" class="admin-btn-secondary">Cancelar</a>
                    <button type="submit" class="admin-btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection