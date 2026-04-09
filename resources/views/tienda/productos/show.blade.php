@extends('layouts.public')

@section('title', isset($producto) ? $producto->nombre : 'Detalle del producto')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('home') }}" class="transition hover:text-slate-900">Inicio</a>
                <span>/</span>
                <a href="{{ route('productos.index') }}" class="transition hover:text-slate-900">Productos</a>
                <span>/</span>
                <span class="font-medium text-slate-700">
                    {{ $producto->nombre ?? 'Producto demo' }}
                </span>
            </nav>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-2">
            <div class="space-y-4">
                <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                   <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}">
                </div>

                <div class="grid grid-cols-4 gap-4">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                            <img
                                src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800&auto=format&fit=crop"
                                alt="Miniatura {{ $i }}"
                                class="h-24 w-full object-cover"
                            >
                        </div>
                    @endfor
                </div>
            </div>

            <div>
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-rose-500 px-3 py-1 text-xs font-bold text-white shadow-sm">
                            Oferta
                        </span>

                        <span class="rounded-full bg-emerald-500 px-3 py-1 text-xs font-bold text-white shadow-sm">
                            En stock
                        </span>

                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                            {{ $producto->categoria->nombre ?? 'Tecnología' }}
                        </span>
                    </div>

                    <h1 class="mt-5 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        {{ $producto->nombre ?? 'Producto demo premium' }}
                    </h1>

                    <p class="mt-4 text-base leading-8 text-slate-600">
                        {{ $producto->descripcion ?? 'Este es un producto demo pensado para mostrar cómo quedaría el detalle de producto dentro del ecommerce. Después lo conectás con tu base real y mantenés toda la estética ya lista.' }}
                    </p>

                    <div class="mt-6 flex items-end gap-4">
                        <div>
                            <p class="text-base text-slate-400 line-through">
                                $120.000
                            </p>
                            <p class="text-4xl font-black tracking-tight text-slate-900">
                                ${{ isset($producto) ? number_format($producto->precio ?? 0, 0, ',', '.') : '89.999' }}
                            </p>
                        </div>

                        <span class="rounded-2xl bg-emerald-50 px-4 py-2 text-sm font-bold text-emerald-700">
                            Ahorrás 25%
                        </span>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Marca</p>
                            <p class="mt-2 text-sm font-semibold text-slate-900">Demo Brand</p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Disponibilidad</p>
                            <p class="mt-2 text-sm font-semibold text-slate-900">Listo para enviar</p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Entrega</p>
                            <p class="mt-2 text-sm font-semibold text-slate-900">Rápida y segura</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col gap-4 sm:flex-row sm:items-center">
                        <div class="inline-flex h-14 items-center rounded-2xl border border-slate-200 bg-white p-1 shadow-sm">
                            <button type="button" class="inline-flex h-12 w-12 items-center justify-center rounded-xl text-lg font-bold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                                -
                            </button>

                            <span class="inline-flex min-w-[3rem] items-center justify-center text-base font-bold text-slate-900">
                                1
                            </span>

                            <button type="button" class="inline-flex h-12 w-12 items-center justify-center rounded-xl text-lg font-bold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                                +
                            </button>
                        </div>

                      <form action="{{ route('carrito.agregar', $producto) }}" method="POST" class="flex-1">
                            @csrf

                            <input type="hidden" name="cantidad" value="1">

                            <button
                                type="submit"
                                class="inline-flex h-14 w-full items-center justify-center rounded-2xl bg-slate-900 px-6 text-sm font-bold text-white shadow-sm transition hover:bg-slate-800">
                                Agregar al carrito
                            </button>
                        </form>

                        <button
                            type="button"
                            class="inline-flex h-14 items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 text-sm font-bold text-slate-700 transition hover:bg-slate-100">
                            Comprar ahora
                        </button>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm font-bold text-slate-900">Pagá como quieras</p>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Tarjetas, transferencia o el medio de pago que después conectes en tu tienda.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm font-bold text-slate-900">Compra con confianza</p>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Una presentación clara del producto mejora la experiencia y transmite más seguridad.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_320px]">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <h2 class="text-2xl font-black tracking-tight text-slate-900">
                        Descripción del producto
                    </h2>

                    <div class="mt-5 space-y-4 text-sm leading-7 text-slate-600 sm:text-base">
                        <p>
                            {{ $producto->descripcion ?? 'Este bloque está pensado para desarrollar mejor la información del producto, destacar beneficios, materiales, funcionalidades y todo lo que ayude a aumentar la conversión.' }}
                        </p>

                        <p>
                            También te sirve para agregar detalles técnicos, condiciones de uso, compatibilidades o cualquier otra información relevante para que la ficha quede completa y profesional.
                        </p>

                        <p>
                            Cuando conectes datos reales, esta sección puede venir directo desde base de datos sin necesidad de tocar el diseño.
                        </p>
                    </div>
                </div>

                <aside class="rounded-[2rem] border border-slate-200 bg-slate-900 p-6 text-white shadow-sm sm:p-8">
                    <h3 class="text-xl font-black tracking-tight">
                        Beneficios de compra
                    </h3>

                    <div class="mt-6 space-y-5">
                        <div>
                            <p class="text-sm font-bold">Envío rápido</p>
                            <p class="mt-1 text-sm leading-6 text-slate-300">
                                Preparado para mostrar tiempos de entrega estimados.
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-bold">Atención personalizada</p>
                            <p class="mt-1 text-sm leading-6 text-slate-300">
                                Ideal para reforzar confianza y acompañar la compra.
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-bold">Diseño escalable</p>
                            <p class="mt-1 text-sm leading-6 text-slate-300">
                                La ficha ya queda lista para crecer sin rehacer estructura.
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
                    También te puede interesar
                </h2>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">
                    Productos relacionados para seguir construyendo una experiencia de compra más completa.
                </p>
            </div>

            <a href="{{ route('productos.index') }}"
               class="hidden sm:inline-flex rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Ver catálogo
            </a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            @for($i = 1; $i <= 4; $i++)
                <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                        <img
                            src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop"
                            alt="Producto relacionado"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                        >

                        <span class="absolute left-3 top-3 rounded-full bg-rose-500 px-3 py-1 text-xs font-bold text-white shadow-sm">
                            Oferta
                        </span>
                    </div>

                    <div class="space-y-4 p-5">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Tecnología
                        </p>

                        <div>
                            <h3 class="line-clamp-2 text-base font-bold text-slate-900">
                                Producto relacionado {{ $i }}
                            </h3>

                            <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">
                                Otra card demo para mantener una línea visual consistente en todo el front.
                            </p>
                        </div>

                        <div class="flex items-end justify-between gap-3">
                            <div>
                                <p class="text-sm text-slate-400 line-through">
                                    $120.000
                                </p>
                                <p class="text-2xl font-black tracking-tight text-slate-900">
                                    $89.999
                                </p>
                            </div>

                            <a href="#"
                               class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                                Ver más
                            </a>
                        </div>
                    </div>
                </article>
            @endfor
        </div>
    </section>
@endsection