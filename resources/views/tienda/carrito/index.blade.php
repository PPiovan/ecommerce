@extends('layouts.public')

@section('title', 'Carrito')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                Tu carrito
            </h1>
            <p class="mt-3 text-sm leading-7 text-slate-600 sm:text-base">
                Revisá tus productos antes de continuar con la compra.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                {{ session('error') }}
            </div>
        @endif

        @if(count($carrito))
            <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_360px]">
                <div class="space-y-5">
                    @foreach($carrito as $item)
                        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                            <div class="flex flex-col gap-5 sm:flex-row">
                                <div class="h-28 w-full overflow-hidden rounded-2xl bg-slate-100 sm:w-32">
                                    <img
                                        src="{{ $item['imagen'] ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop' }}"
                                        alt="{{ $item['nombre'] }}"
                                        class="h-full w-full object-cover"
                                    >
                                </div>

                                <div class="flex-1">
                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                        <div>
                                            <h2 class="text-lg font-black tracking-tight text-slate-900">
                                                {{ $item['nombre'] }}
                                            </h2>

                                            <p class="mt-2 text-sm text-slate-500">
                                                Precio unitario: ${{ number_format($item['precio'], 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>

                                    <div class="mt-5 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                                        <form action="{{ route('carrito.actualizar', $item['id']) }}" method="POST" class="flex items-end gap-3">
                                            @csrf

                                            <div>
                                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                                    Cantidad
                                                </label>
                                                <input
                                                    type="number"
                                                    name="cantidad"
                                                    min="1"
                                                    max="{{ max(1, $item['stock']) }}"
                                                    value="{{ $item['cantidad'] }}"
                                                    class="h-11 w-24 rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-700 outline-none focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                                                >
                                            </div>

                                            <button
                                                type="submit"
                                                class="h-11 rounded-2xl bg-slate-900 px-4 text-sm font-semibold text-white transition hover:bg-slate-800">
                                                Actualizar
                                            </button>
                                        </form>

                                        <div class="text-right">
                                            <p class="text-sm text-slate-500">Subtotal</p>
                                            <p class="text-2xl font-black tracking-tight text-slate-900">
                                                ${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <aside class="h-fit rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-xl font-black tracking-tight text-slate-900">
                        Resumen de compra
                    </h3>

                    <div class="mt-6 space-y-4">
                        <div class="flex items-center justify-between text-sm text-slate-600">
                            <span>Productos</span>
                            <span>{{ count($carrito) }}</span>
                        </div>

                        <div class="flex items-center justify-between text-base font-semibold text-slate-700">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="border-t border-slate-200 pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-slate-900">Total</span>
                                <span class="text-3xl font-black tracking-tight text-slate-900">
                                    ${{ number_format($subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">

                        <a href="{{ route('cliente.checkout.index') }}"
                           class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-slate-800">
                                Finalizar compra
                        </a>
    

                        <form action="{{ route('carrito.vaciar') }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-100">
                                Vaciar carrito
                            </button>
                        </form>
                    </div>
                </aside>
            </div>
        @else
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm">
                <h2 class="text-2xl font-black tracking-tight text-slate-900">
                    Tu carrito está vacío
                </h2>
                <p class="mt-3 text-sm leading-7 text-slate-500 sm:text-base">
                    Todavía no agregaste productos. Explorá el catálogo y empezá a comprar.
                </p>

                <a
                    href="{{ route('productos.index') }}"
                    class="mt-6 inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-slate-800">
                    Ir a productos
                </a>
            </div>
        @endif
    </section>
@endsection