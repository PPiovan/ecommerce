@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.22em] text-slate-400">
                    Administración
                </p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">
                    Ventas
                </h1>
                <p class="mt-2 text-sm text-slate-500">
                    Gestioná las ventas, revisá clientes y actualizá estados.
                </p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <form method="GET" action="{{ route('admin.ventas.index') }}" class="grid gap-4 md:grid-cols-3">
                <div class="md:col-span-2">
                    <label for="buscar" class="mb-2 block text-sm font-semibold text-slate-700">
                        Buscar
                    </label>
                    <input
                        id="buscar"
                        type="text"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        placeholder="Buscar por ID, nombre o email"
                        class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                    >
                </div>

                <div>
                    <label for="estado" class="mb-2 block text-sm font-semibold text-slate-700">
                        Estado
                    </label>
                    <select
                        id="estado"
                        name="estado"
                        class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                    >
                        <option value="">Todos</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado }}" @selected(request('estado') === $estado)>
                                {{ ucfirst($estado) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-3 flex flex-wrap gap-3">
                    <button
                        type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-full bg-slate-900 px-5 text-sm font-bold text-white transition hover:bg-slate-800"
                    >
                        Filtrar
                    </button>

                    <a href="{{ route('admin.ventas.index') }}"
                       class="inline-flex h-11 items-center justify-center rounded-full border border-slate-200 px-5 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Pedido</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Cliente</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Fecha</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Items</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Estado</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($ventas as $venta)
                            <tr class="hover:bg-slate-50/70">
                                <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                    #{{ $venta->id }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-slate-900">
                                        {{ $venta->user->name ?? 'Sin usuario' }}
                                    </div>
                                    <div class="text-sm text-slate-500">
                                        {{ $venta->user->email ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-700">
                                    {{ optional($venta->fecha ?? $venta->created_at)->format('d/m/Y H:i') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-700">
                                    {{ $venta->detalles_count }}
                                </td>

                                <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                    ${{ number_format($venta->total, 2, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $venta->estado_badge_classes }}">
                                        {{ $venta->estado_label }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.ventas.show', $venta) }}"
                                       class="inline-flex h-10 items-center justify-center rounded-full border border-slate-200 px-4 text-sm font-bold text-slate-700 transition hover:bg-slate-100">
                                        Ver detalle
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-sm text-slate-500">
                                    No se encontraron ventas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $ventas->links() }}
        </div>
    </div>
@endsection