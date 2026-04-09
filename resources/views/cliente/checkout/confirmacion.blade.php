@extends('layouts.public')

@section('title', 'Compra confirmada')

@section('content')
    <section class="bg-slate-50 py-12 sm:py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm sm:p-10">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>

                <div class="mt-6 text-center">
                    <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.22em] text-emerald-700">
                        Compra confirmada
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        ¡Tu pedido fue registrado con éxito!
                    </h1>

                    <p class="mx-auto mt-3 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                        Guardamos correctamente tu compra. Podés revisar el detalle del pedido y seguir su estado desde tu cuenta.
                    </p>
                </div>

                <div class="mt-8 grid gap-4 rounded-[2rem] bg-slate-50 p-6 sm:grid-cols-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Pedido</p>
                        <p class="mt-1 text-base font-bold text-slate-900">#{{ $venta->id }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Estado</p>
                        <span class="mt-1 inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $venta->estado_badge_classes }}">
                            {{ $venta->estado_label }}
                        </span>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Total</p>
                        <p class="mt-1 text-base font-bold text-slate-900">
                            ${{ number_format($venta->total, 2, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
                    <a href="{{ route('cliente.ventas.show', $venta) }}"
                       class="inline-flex h-12 items-center justify-center rounded-full bg-slate-900 px-6 text-sm font-bold text-white transition hover:bg-slate-800">
                        Ver detalle del pedido
                    </a>

                    <a href="{{ route('cliente.ventas.index') }}"
                       class="inline-flex h-12 items-center justify-center rounded-full border border-slate-200 px-6 text-sm font-bold text-slate-800 transition hover:bg-slate-50">
                        Ir a mis compras
                    </a>

                    <a href="{{ route('productos.index') }}"
                       class="inline-flex h-12 items-center justify-center rounded-full border border-slate-200 px-6 text-sm font-bold text-slate-800 transition hover:bg-slate-50">
                        Seguir comprando
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection