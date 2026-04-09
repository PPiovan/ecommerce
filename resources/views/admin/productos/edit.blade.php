@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">Editar producto</h3>
            </div>

            <div class="p-6">
                <form action="{{ route('admin.productos.update', $producto) }}" method="POST" enctype="multipart/form-data" class="admin-form">
                    @csrf
                    @method('PUT')

                    <div class="admin-form-group">
                        <label class="admin-label">Categoría (*)</label>

                        <select name="categoria_id" class="admin-input">
                            <option value="">Seleccionar categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('categoria_id')
                            <p class="admin-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label">Nombre (*)</label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre', $producto->nombre) }}"
                            class="admin-input"
                        >

                        @error('nombre')
                            <p class="admin-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label">Slug (*)</label>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug', $producto->slug) }}"
                            class="admin-input"
                        >

                        <p class="admin-help">
                            URL amigable. Ej: iphone-13-pro
                        </p>

                        @error('slug')
                            <p class="admin-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label">Descripción</label>

                        <textarea
                            name="descripcion"
                            rows="5"
                            class="admin-textarea"
                        >{{ old('descripcion', $producto->descripcion) }}</textarea>

                        @error('descripcion')
                            <p class="admin-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="admin-form-group">
                            <label class="admin-label">Precio (*)</label>

                            <input
                                type="number"
                                step="0.01"
                                name="precio"
                                value="{{ old('precio', $producto->precio) }}"
                                class="admin-input"
                            >

                            @error('precio')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-label">Stock (*)</label>

                            <input
                                type="number"
                                name="stock"
                                value="{{ old('stock', $producto->stock) }}"
                                class="admin-input"
                            >

                            @error('stock')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label">Imagen principal</label>

                        <div class="mb-4">
                            <p class="admin-help mb-2">Vista previa:</p>

                            <img
                                id="preview-imagen"
                                src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'https://placehold.co/160x160?text=Preview' }}"
                                alt="{{ $producto->nombre }}"
                                class="w-32 h-32 rounded-xl object-cover border border-slate-200"
                            >
                        </div>

                        <input
                            type="file"
                            id="imagen"
                            name="imagen"
                            accept="image/*"
                            class="admin-input"
                        >

                        <p class="admin-help">
                            Si seleccionás una nueva imagen, reemplazará la actual.
                        </p>

                        @error('imagen')
                            <p class="admin-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap items-center gap-6">
                        <label class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="activo"
                                value="1"
                                {{ old('activo', $producto->activo) ? 'checked' : '' }}
                                class="admin-checkbox"
                            >
                            <span class="admin-checkbox-label">Activo</span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="destacado"
                                value="1"
                                {{ old('destacado', $producto->destacado) ? 'checked' : '' }}
                                class="admin-checkbox"
                            >
                            <span class="admin-checkbox-label">Destacado</span>
                        </label>
                    </div>

                    <div class="admin-form-actions">
                        <a href="{{ route('admin.productos.index') }}" class="admin-btn-secondary">
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

    @push('scripts')
    <script>
        const nombreInput = document.getElementById('nombre');
        const slugInput = document.getElementById('slug');
        const imagenInput = document.getElementById('imagen');
        const previewImagen = document.getElementById('preview-imagen');

        if (nombreInput && slugInput) {
            let slugEditadoManualmente = slugInput.value.trim() !== '';

            nombreInput.addEventListener('input', function () {
                if (!slugEditadoManualmente) {
                    slugInput.value = this.value
                        .toLowerCase()
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '')
                        .replace(/[^a-z0-9\s-]/g, '')
                        .trim()
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                }
            });

            slugInput.addEventListener('input', function () {
                slugEditadoManualmente = this.value.trim() !== '';
            });
        }

        if (imagenInput && previewImagen) {
            imagenInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (event) {
                    previewImagen.src = event.target.result;
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
    @endpush
@endsection