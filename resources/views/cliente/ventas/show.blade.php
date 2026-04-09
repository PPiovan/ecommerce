@extends('layouts.public')

@section('title', 'Detalle de compra')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <a href="{{ route('cliente.ventas.index') }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-slate-900">
                        <span>←</span>
                        <span>Volver a mis compras</span>
                    </a>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        Pedido #{{ $venta->id }}
                    </h1>

                    <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                        Realizado el {{ optional($venta->fecha ?? $venta->created_at)->format('d/m/Y \a \l\a\s H:i') }}.
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                        Estado actual
                    </p>
                    <span class="mt-1 inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $venta->estado_badge_classes }}">
                        {{ $venta->estado_label }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-10 sm:py-12">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <div class="space-y-6 lg:col-span-8">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <div class="flex flex-col gap-3 border-b border-slate-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h2 class="text-2xl font-black tracking-tight text-slate-950">
                                Seguimiento del pedido
                            </h2>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Podés ver en qué etapa se encuentra actualmente tu compra.
                            </p>
                        </div>
                    </div>

                    @if($venta->estado === \App\Models\Venta::ESTADO_CANCELADA)
                        <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm font-semibold text-rose-700">
                            Este pedido fue cancelado.
                        </div>
                    @else
                        <div class="mt-8 grid gap-4 md:grid-cols-5">
                            @foreach($venta->timeline as $paso => $label)
                                <div class="relative">
                                    <div class="flex items-center gap-3 md:flex-col md:items-start">
                                        <div class="flex h-11 w-11 items-center justify-center rounded-full text-sm font-black
                                            {{ $paso <= $venta->paso_seguimiento ? 'bg-slate-900 text-white' : 'bg-slate-200 text-slate-500' }}">
                                            {{ $paso }}
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold {{ $paso <= $venta->paso_seguimiento ? 'text-slate-900' : 'text-slate-400' }}">
                                                {{ $label }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <h2 class="text-2xl font-black tracking-tight text-slate-950">
                        Productos comprados
                    </h2>

                    <div class="mt-6 space-y-4">
                        @forelse($venta->detalles as $detalle)
                            <article class="flex flex-col gap-4 rounded-3xl border border-slate-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                                <div class="min-w-0">
                                    <p class="text-base font-bold text-slate-900">
                                        {{ $detalle->producto->nombre ?? 'Producto sin nombre' }}
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
                                Esta venta no tiene detalles cargados todavía.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <aside class="space-y-6 lg:col-span-4">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-black tracking-tight text-slate-950">
                        Resumen
                    </h2>

                    <div class="mt-5 space-y-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Pedido</span>
                            <span class="font-semibold text-slate-900">#{{ $venta->id }}</span>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Fecha</span>
                            <span class="font-semibold text-slate-900">
                                {{ optional($venta->fecha ?? $venta->created_at)->format('d/m/Y') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Estado</span>
                            <span class="font-semibold text-slate-900">
                                {{ $venta->estado_label }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Cantidad de productos</span>
                            <span class="font-semibold text-slate-900">
                                {{ $venta->cantidad_items }}
                            </span>
                        </div>

                        @if(!is_null($venta->metodo_pago))
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

                @if(!empty($venta->observaciones))
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
    </section>
@endsection