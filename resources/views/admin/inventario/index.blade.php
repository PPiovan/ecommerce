@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="mb-6 admin-badge-success px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-xl bg-red-100 border border-red-200 text-red-800 px-4 py-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-1">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3 class="admin-card-title">Nuevo movimiento</h3>
                </div>

                <div class="p-6">
                    <form action="{{ route('admin.inventario.store') }}" method="POST" class="admin-form">
                        @csrf

                        <div class="admin-form-group">
                            <label class="admin-label">Producto (*)</label>

                            <select name="producto_id" class="admin-input">
                                <option value="">Seleccionar producto</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                        {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                                    </option>
                                @endforeach
                            </select>

                            @error('producto_id')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-label">Tipo (*)</label>

                            <select name="tipo" class="admin-input">
                                <option value="">Seleccionar tipo</option>
                                <option value="ingreso" {{ old('tipo') == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                                <option value="egreso" {{ old('tipo') == 'egreso' ? 'selected' : '' }}>Egreso</option>
                                <option value="ajuste" {{ old('tipo') == 'ajuste' ? 'selected' : '' }}>Ajuste</option>
                            </select>

                            @error('tipo')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-label">Cantidad (*)</label>

                            <input
                                type="number"
                                name="cantidad"
                                value="{{ old('cantidad') }}"
                                class="admin-input"
                            >

                            @error('cantidad')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-label">Motivo</label>

                            <input
                                type="text"
                                name="motivo"
                                value="{{ old('motivo') }}"
                                class="admin-input"
                            >

                            @error('motivo')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-label">Detalle</label>

                            <textarea
                                name="detalle"
                                rows="4"
                                class="admin-textarea"
                            >{{ old('detalle') }}</textarea>

                            @error('detalle')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full admin-btn-primary">
                            Registrar movimiento
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="xl:col-span-2">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3 class="admin-card-title">Historial de movimientos</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="admin-table">
                        <thead class="admin-table-head">
                            <tr>
                                <th class="text-left px-6 py-4 font-semibold">Fecha</th>
                                <th class="text-left px-6 py-4 font-semibold">Producto</th>
                                <th class="text-left px-6 py-4 font-semibold">Tipo</th>
                                <th class="text-left px-6 py-4 font-semibold">Cantidad</th>
                                <th class="text-left px-6 py-4 font-semibold">Motivo</th>
                                <th class="text-left px-6 py-4 font-semibold">Usuario</th>
                                <th class="text-left px-6 py-4 font-semibold">Stock anterior</th>
                                <th class="text-left px-6 py-4 font-semibold">Stock nuevo</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($movimientos as $movimiento)
                                <tr class="admin-table-row">
                                    <td class="px-6 py-4">{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>

                                    <td class="px-6 py-4 font-medium">
                                        {{ $movimiento->producto->nombre }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($movimiento->tipo === 'ingreso')
                                            <span class="admin-badge-success">Ingreso</span>
                                        @elseif($movimiento->tipo === 'egreso')
                                            <span class="admin-badge-danger">Egreso</span>
                                        @else
                                            <span class="admin-badge-warning">Ajuste</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">{{ $movimiento->cantidad }}</td>
                                    <td class="px-6 py-4">{{ $movimiento->motivo ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $movimiento->usuario->name ?? 'Sistema' }}</td>
                                    <td class="px-6 py-4">{{ $movimiento->stock_anterior }}</td>
                                    <td class="px-6 py-4">{{ $movimiento->stock_nuevo }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-8 py-12 text-center text-slate-500">
                                        No hay movimientos registrados todavía.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $movimientos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection