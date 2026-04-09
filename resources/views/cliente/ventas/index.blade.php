@extends('layouts.public')

@section('title', 'Mis compras')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.22em] text-slate-500">
                        Mi cuenta
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        Mis compras
                    </h1>

                    <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                        Acá vas a poder revisar todas las compras realizadas desde tu cuenta.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    @if(Route::has('profile.edit'))
                        <a href="{{ route('profile.edit') }}"
                           class="inline-flex items-center justify-center rounded-full border border-slate-200 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                            Volver a mi cuenta
                        </a>
                    @endif

                    <a href="{{ route('productos.index') }}"
                       class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800">
                        Seguir comprando
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-10 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if($ventas->count())
                <div class="space-y-4">
                    @foreach($ventas as $venta)
                        @php
                            $estado = strtolower($venta->estado ?? 'pendiente');

                            $badgeClasses = match($estado) {
                                'pagada', 'entregada' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                                'enviada' => 'border-sky-200 bg-sky-50 text-sky-700',
                                'cancelada' => 'border-rose-200 bg-rose-50 text-rose-700',
                                'preparando' => 'border-violet-200 bg-violet-50 text-violet-700',
                                default => 'border-amber-200 bg-amber-50 text-amber-700',
                            };
                        @endphp

                        <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex flex-col gap-6 xl:flex-row xl:items-center xl:justify-between">
                                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4 xl:gap-8">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                                            N° de pedido
                                        </p>
                                        <p class="mt-1 text-sm font-bold text-slate-900">
                                            #{{ $venta->id }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                                            Fecha
                                        </p>
                                        <p class="mt-1 text-sm font-semibold text-slate-900">
                                            {{ optional($venta->fecha ?? $venta->created_at)->format('d/m/Y H:i') }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                                            Productos
                                        </p>
                                        <p class="mt-1 text-sm font-semibold text-slate-900">
                                            {{ $venta->detalles_count }} item(s)
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                                            Total
                                        </p>
                                        <p class="mt-1 text-sm font-bold text-slate-900">
                                            ${{ number_format($venta->total, 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                    <span class="inline-flex items-center justify-center rounded-full border px-3 py-2 text-xs font-bold uppercase tracking-wide {{ $venta->estado_badge_classes }}">
                                        {{ $venta->estado_label }}
                                    </span>

                                    <a href="{{ route('cliente.ventas.show', $venta) }}"
                                       class="inline-flex h-11 items-center justify-center rounded-full border border-slate-200 px-5 text-sm font-bold text-slate-800 transition hover:bg-slate-50">
                                        Ver detalle
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $ventas->links() }}
                </div>
            @else
                <div class="rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-sm">
                    <h2 class="text-2xl font-black tracking-tight text-slate-900">
                        Todavía no tenés compras registradas
                    </h2>

                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        Cuando completes tu primera compra, la vas a ver acá con su detalle y estado.
                    </p>

                    <a href="{{ route('productos.index') }}"
                       class="mt-6 inline-flex h-12 items-center justify-center rounded-full bg-slate-900 px-6 text-sm font-bold text-white transition hover:bg-slate-800">
                        Explorar productos
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection