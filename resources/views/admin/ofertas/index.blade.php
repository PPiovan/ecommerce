@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="mb-6 admin-badge-success px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3 class="admin-card-title">Listado de ofertas</h3>
                <p class="admin-card-subtitle">Administrá las promociones activas</p>
            </div>

            <a href="{{ route('admin.ofertas.create') }}" class="admin-btn-primary">
                Nueva oferta
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead class="admin-table-head">
                    <tr>
                        <th class="text-left px-6 py-4 font-semibold">ID</th>
                        <th class="text-left px-6 py-4 font-semibold">Producto</th>
                        <th class="text-left px-6 py-4 font-semibold">Tipo</th>
                        <th class="text-left px-6 py-4 font-semibold">Valor</th>
                        <th class="text-left px-6 py-4 font-semibold">Inicio</th>
                        <th class="text-left px-6 py-4 font-semibold">Fin</th>
                        <th class="text-left px-6 py-4 font-semibold">Estado</th>
                        <th class="text-left px-6 py-4 font-semibold">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($ofertas as $oferta)
                        <tr class="admin-table-row">
                            <td class="px-6 py-4">{{ $oferta->id }}</td>

                            <td class="px-6 py-4 font-medium">
                                {{ $oferta->producto->nombre }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $oferta->tipo === 'porcentaje' ? 'Porcentaje' : 'Monto fijo' }}
                            </td>

                            <td class="px-6 py-4">
                                @if($oferta->tipo === 'porcentaje')
                                    {{ rtrim(rtrim(number_format($oferta->valor, 2, ',', '.'), '0'), ',') }}%
                                @else
                                    ${{ number_format($oferta->valor, 2, ',', '.') }}
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                {{ $oferta->fecha_inicio?->format('d/m/Y') ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $oferta->fecha_fin?->format('d/m/Y') ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                @if($oferta->estaVigente())
                                    <span class="admin-badge-success">Vigente</span>
                                @else
                                    <span class="admin-badge-neutral">Inactiva</span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.ofertas.edit', $oferta) }}"
                                       class="admin-btn-edit">
                                        Editar
                                    </a>

                                    <form action="{{ route('admin.ofertas.destroy', $oferta) }}" method="POST" onsubmit="return confirm('¿Eliminar esta oferta?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="admin-btn-delete">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-slate-500">
                                No hay ofertas cargadas todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-200">
            {{ $ofertas->links() }}
        </div>
    </div>
@endsection