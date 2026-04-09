@extends('layouts.public')

@section('title', 'Inicio')

@section('content')
    @php
        $heroProducto = $productosDestacados->first();
    @endphp

    {{-- HERO --}}
    <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid overflow-hidden rounded-[2rem] bg-slate-100 lg:grid-cols-2">
                <div class="flex items-center p-8 sm:p-12 lg:p-16">
                    <div class="max-w-xl">
                        <span class="inline-flex rounded-full bg-white px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500 shadow-sm">
                            Tienda online
                        </span>

                        <h1 class="mt-5 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl">
                            Comprá lo mejor,
                            <span class="text-slate-500">más fácil.</span>
                        </h1>

                        <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base">
                            Productos destacados, categorías claras y una experiencia simple para comprar rápido.
                        </p>

                        <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('productos.index') }}"
                               class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3.5 text-sm font-bold text-white transition hover:bg-slate-800">
                                Comprar ahora
                            </a>

                            <a href="#destacados"
                               class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3.5 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                                Ver destacados
                            </a>
                        </div>
                    </div>
                </div>

                <div class="relative min-h-[320px] bg-slate-200">
                    <img
                        src="{{ $heroProducto?->imagen_url ?? 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1400&auto=format&fit=crop' }}"
                        alt="{{ $heroProducto?->nombre ?? 'Producto destacado' }}"
                        class="h-full w-full object-cover"
                    >

                    @if($heroProducto)
                        <div class="absolute bottom-4 left-4 right-4 rounded-2xl bg-white/90 p-4 shadow-lg backdrop-blur">
                            <p class="line-clamp-1 text-sm font-semibold text-slate-500">
                                {{ $heroProducto->categoria->nombre ?? 'Producto destacado' }}
                            </p>
                            <div class="mt-1 flex items-end justify-between gap-4">
                                <h2 class="line-clamp-2 text-lg font-black text-slate-900">
                                    {{ $heroProducto->nombre }}
                                </h2>
                                <p class="shrink-0 text-lg font-black text-slate-900">
                                    ${{ number_format($heroProducto->precio ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- CATEGORÍAS --}}
   <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center gap-3 border-y border-slate-200 py-4">
                <span class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                    Explorar
                </span>

                @forelse($categorias->take(8) as $categoria)
                    <a href="{{ route('categorias.show', $categoria) }}"
                    class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-900 hover:bg-slate-900 hover:text-white">
                        {{ $categoria->nombre }}
                    </a>
                @empty
                    <span class="text-sm text-slate-500">No hay categorías disponibles.</span>
                @endforelse
            </div>
        </div>
    </section>

    {{-- DESTACADOS --}}
    <section id="destacados" class="bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
                    Destacados
                </h2>

                <a href="{{ route('productos.index') }}"
                   class="text-sm font-semibold text-slate-600 transition hover:text-slate-900">
                    Ver catálogo
                </a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                @forelse($productosDestacados as $producto)
                    <x-public.product-card :producto="$producto" />
                @empty
                    <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-500">
                        No hay productos destacados todavía.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- NOVEDADES --}}
    <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
                    Novedades
                </h2>

                <a href="{{ route('productos.index') }}"
                   class="text-sm font-semibold text-slate-600 transition hover:text-slate-900">
                    Ver más
                </a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                @forelse($productosRecientes as $producto)
                    <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="overflow-hidden bg-slate-100">
                            <img
                                src="{{ $producto->imagen_url }}"
                                alt="{{ $producto->nombre }}"
                                class="h-60 w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        </div>

                        <div class="p-5">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                {{ $producto->categoria->nombre ?? 'Categoría' }}
                            </p>

                            <h3 class="mt-2 line-clamp-2 text-base font-bold text-slate-900">
                                {{ $producto->nombre }}
                            </h3>

                            <div class="mt-4 flex items-center justify-between">
                                <p class="text-xl font-black text-slate-900">
                                    ${{ number_format($producto->precio ?? 0, 0, ',', '.') }}
                                </p>

                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                    Nuevo
                                </span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-10 text-center text-slate-500">
                        No hay productos recientes todavía.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection