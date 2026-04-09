@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <a href="{{ route('admin.ventas.index') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-slate-900">
                    <span>←</span>
                    <span>Volver a ventas</span>
                </a>

                <h1 class="mt-3 text-3xl font-black tracking-tight text-slate-900">
                    Venta #{{ $venta->id }}
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Revisá el detalle completo y actualizá el estado del pedido.
                </p>
            </div>

            <span class="inline-flex rounded-full border px-3 py-2 text-xs font-bold uppercase tracking-wide {{ $venta->estado_badge_classes }}">
                {{ $venta->estado_label }}
            </span>
        </div>

        @if(session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-12">
            <div class="space-y-6 xl:col-span-8">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <h2 class="text-2xl font-black tracking-tight text-slate-950">
                        Productos
                    </h2>

                    <div class="mt-6 space-y-4">
                        @forelse($venta->detalles as $detalle)
                            <article class="flex flex-col gap-4 rounded-3xl border border-slate-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-base font-bold text-slate-900">
                                        {{ $detalle->producto->nombre ?? 'Producto eliminado' }}
                                    </p>
                                    <p class="mt-1 text-sm text-slate-500">
                                        Cantidad: {{ $detalle->cantidad }}
                                    </p>
                                </div>

                                <div class="text-left sm:text-right">
                                    <p class="text-sm text-slate-500">Precio unitario</p>
                                    <p class="text-sm font-semibold text-slate-900">
                                        ${{ number_format($detalle->precio_unitario, 2, ',', '.') }}
                                    </p>
                                </div>

                                <div class="text-left sm:text-right">
                                    <p class="text-sm text-slate-500">Subtotal</p>
                                    <p class="text-base font-bold text-slate-900">
                                        ${{ number_format($detalle->subtotal, 2, ',', '.') }}
                                    </p>
                                </div>
                            </article>
                        @empty
                            <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-500">
                                Esta venta no tiene detalles cargados.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <aside class="space-y-6 xl:col-span-4">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-black tracking-tight text-slate-950">
                        Datos de la venta
                    </h2>

                    <div class="mt-5 space-y-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Pedido</span>
                            <span class="font-semibold text-slate-900">#{{ $venta->id }}</span>
                        </div>

                        <div class="flex items-center justify-between gap-4 text-sm">
                            <span class="text-slate-500">Cliente</span>
                            <span class="text-right font-semibold text-slate-900">
                                {{ $venta->user->name ?? '-' }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-4 text-sm">
                            <span class="text-slate-500">Correo</span>
                            <span class="break-all text-right font-semibold text-slate-900">
                                {{ $venta->user->email ?? '-' }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Fecha</span>
                            <span class="font-semibold text-slate-900">
                                {{ optional($venta->fecha ?? $venta->created_at)->format('d/m/Y H:i') }}
                            </span>
                        </div>

                        @if($venta->metodo_pago)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Método de pago</span>
                                <span class="font-semibold text-slate-900">
                                    {{ $venta->metodo_pago }}
                                </span>
                            </div>
                        @endif

                        <div class="border-t border-slate-200 pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-slate-600">Total</span>
                                <span class="text-lg font-black text-slate-950">
                                    ${{ number_format($venta->total, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @can('ventas.editar')
                    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-black tracking-tight text-slate-950">
                            Actualizar estado
                        </h2>

                        <form method="POST" action="{{ route('admin.ventas.updateEstado', $venta) }}" class="mt-5 space-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="estado" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Estado
                                </label>
                                <select
                                    id="estado"
                                    name="estado"
                                    class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                                >
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado }}" @selected($venta->estado === $estado)>
                                            {{ ucfirst($estado) }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('estado')
                                    <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="inline-flex h-12 w-full items-center justify-center rounded-full bg-slate-900 px-6 text-sm font-bold text-white transition hover:bg-slate-800"
                            >
                                Guardar estado
                            </button>
                        </form>
                    </div>
                @endcan

                @if($venta->observaciones)
                    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-black tracking-tight text-slate-950">
                            Observaciones
                        </h2>

                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            {{ $venta->observaciones }}
                        </p>
                    </div>
                @endif
            </aside>
        </div>
    </div>
@endsection