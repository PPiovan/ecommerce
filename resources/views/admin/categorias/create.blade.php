@extends('layouts.admin')

@section('content')
<div class="max-w-2xl">

    <div class="admin-card">

        <div class="admin-card-header">
            <h3 class="admin-card-title">
                Creación de una nueva categoría
            </h3>
        </div>

        <div class="p-6">

            <div class="mb-6 rounded-xl bg-slate-50 border border-slate-200 px-4 py-3">
                <p class="admin-card-subtitle">
                    Llene los campos del formulario
                </p>
            </div>

            <form action="{{ route('admin.categorias.store') }}" method="POST" class="admin-form">
                @csrf

                <div class="admin-form-group">
                    <label for="nombre" class="admin-label">
                        Nombre (*)
                    </label>

                    <div class="admin-input-icon-wrap">
                        <span class="admin-input-icon">
                            🏷️
                        </span>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            placeholder="Nombre de la categoría"
                            class="admin-input admin-input-with-icon"
                        >
                    </div>

                    @error('nombre')
                        <p class="admin-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="slug" class="admin-label">
                        Slug (*)
                    </label>

                    <div class="admin-input-icon-wrap">
                        <span class="admin-input-icon">
                            🔗
                        </span>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            placeholder="slug-de-la-categoria"
                            class="admin-input admin-input-with-icon"
                        >
                    </div>

                    <p class="admin-help">
                        URL amigable. Ej: electronica, ropa-deportiva
                    </p>

                    @error('slug')
                        <p class="admin-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="descripcion" class="admin-label">
                        Descripción
                    </label>

                    <div class="admin-input-icon-wrap">
                        <span class="admin-textarea-icon">
                            ☰
                        </span>

                        <textarea
                            id="descripcion"
                            name="descripcion"
                            rows="5"
                            placeholder="Descripción de la categoría (opcional)"
                            class="admin-textarea admin-textarea-with-icon"
                        >{{ old('descripcion') }}</textarea>
                    </div>

                    @error('descripcion')
                        <p class="admin-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <input
                        type="checkbox"
                        id="activo"
                        name="activo"
                        value="1"
                        {{ old('activo', true) ? 'checked' : '' }}
                        class="admin-checkbox"
                    >

                    <label for="activo" class="admin-checkbox-label">
                        Categoría activa
                    </label>
                </div>

                <div class="admin-form-actions">

                    <a href="{{ route('admin.categorias.index') }}"
                       class="admin-btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="admin-btn-primary">
                        Registrar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    document.getElementById('nombre').addEventListener('input', function () {
    let slug = this.value
        .toLowerCase()
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '');

    document.getElementById('slug').value = slug;
});
</script>
@endsection