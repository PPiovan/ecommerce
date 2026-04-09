@extends('layouts.admin')

@section('content')

<div class="max-w-3xl">

    <div class="admin-card">

        <div class="admin-card-header">
            <h3 class="admin-card-title">Crear nueva oferta</h3>
        </div>

        <div class="p-6">

            <form action="{{ route('admin.ofertas.store') }}" method="POST" class="admin-form">
                @csrf

                <div class="admin-form-group">
                    <label class="admin-label">Producto (*)</label>

                    <select name="producto_id" class="admin-input">
                        <option value="">Seleccionar producto</option>

                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }} - ${{ number_format($producto->precio, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>

                    @error('producto_id')
                        <p class="admin-error">{{ $message }}</p>
                    @enderror
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="admin-form-group">
                        <label class="admin-label">Tipo (*)</label>

                        <select name="tipo" class="admin-input">
                            <option value="">Seleccionar tipo</option>

                            <option value="porcentaje" {{ old('tipo') == 'porcentaje' ? 'selected' : '' }}>
                                Porcentaje
                            </option>

                            <option value="monto_fijo" {{ old('tipo') == 'monto_fijo' ? 'selected' : '' }}>
                                Monto fijo
                            </option>
                        </select>

                        @error('tipo')
                            <p class="admin-error">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="admin-form-group">
                        <label class="admin-label">Valor (*)</label>

                        <input
                            type="number"
                            step="0.01"
                            name="valor"
                            value="{{ old('valor') }}"
                            class="admin-input"
                        >

                        @error('valor')
                            <p class="admin-error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="admin-form-group">
                        <label class="admin-label">Fecha inicio</label>

                        <input
                            type="date"
                            name="fecha_inicio"
                            value="{{ old('fecha_inicio') }}"
                            class="admin-input"
                        >

                        @error('fecha_inicio')
                            <p class="admin-error">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="admin-form-group">
                        <label class="admin-label">Fecha fin</label>

                        <input
                            type="date"
                            name="fecha_fin"
                            value="{{ old('fecha_fin') }}"
                            class="admin-input"
                        >

                        @error('fecha_fin')
                            <p class="admin-error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                <div class="flex items-center gap-3">

                    <input
                        type="checkbox"
                        name="activa"
                        value="1"
                        {{ old('activa', true) ? 'checked' : '' }}
                        class="admin-checkbox"
                    >

                    <label class="admin-checkbox-label">
                        Oferta activa
                    </label>

                </div>


                <div class="admin-form-actions">

                    <a href="{{ route('admin.ofertas.index') }}" class="admin-btn-secondary">
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