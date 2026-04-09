@extends('layouts.public')

@section('title', $categoria->nombre)

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('home') }}" class="transition hover:text-slate-900">Inicio</a>
                <span>/</span>
                <a href="{{ route('categorias.index') }}" class="transition hover:text-slate-900">Categorías</a>
                <span>/</span>
                <span class="font-medium text-slate-700">{{ $categoria->nombre }}</span>
            </nav>

            <div class="mt-6 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                        Categoría
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        {{ $categoria->nombre }}
                    </h1>

                    <p class="mt-3 text-sm leading-7 text-slate-600 sm:text-base">
                        {{ $categoria->descripcion ?: 'Descubrí los productos disponibles dentro de esta categoría.' }}
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50 px-6 py-4 text-center">
                    <p class="text-lg font-black text-slate-900">
                        {{ $productos->total() }}
                    </p>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Productos
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[280px_minmax(0,1fr)]">
            <aside class="h-fit rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <form action="{{ route('categorias.show', $categoria) }}" method="GET" class="space-y-6">
                    <h2 class="text-lg font-black text-slate-900">
                        Filtros
                    </h2>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Buscar
                        </label>

                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            placeholder="Nombre del producto..."
                            class="h-11 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none focus:ring-4 focus:ring-slate-200"
                        >
                    </div>

                    <div>
                        <p class="mb-3 text-sm font-semibold text-slate-700">
                            Precio
                        </p>

                        <div class="grid grid-cols-2 gap-3">
                            <input
                                type="number"
                                name="precio_min"
                                value="{{ request('precio_min') }}"
                                placeholder="Min"
                                class="h-11 rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm"
                            >

                            <input
                                type="number"
                                name="precio_max"
                                value="{{ request('precio_max') }}"
                                placeholder="Max"
                                class="h-11 rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm"
                            >
                        </div>
                    </div>

                    <div>
                        <p class="mb-3 text-sm font-semibold text-slate-700">
                            Disponibilidad
                        </p>

                        <div class="space-y-2">
                            <label class="flex items-center gap-3 text-sm text-slate-600">
                                <input
                                    type="radio"
                                    name="stock"
                                    value="con_stock"
                                    {{ request('stock') === 'con_stock' ? 'checked' : '' }}
                                    class="h-4 w-4"
                                >
                                <span>En stock</span>
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-600">
                                <input
                                    type="radio"
                                    name="stock"
                                    value=""
                                    {{ request('stock') === null ? 'checked' : '' }}
                                    class="h-4 w-4"
                                >
                                <span>Todos</span>
                            </label>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800">
                        Aplicar filtros
                    </button>
                </form>
            </aside>

            <div>
                <div class="mb-6 flex items-center justify-between gap-4">
                    <p class="text-sm text-slate-600">
                        Mostrando {{ $productos->count() }} de {{ $productos->total() }} productos
                    </p>

                    <form method="GET" action="{{ route('categorias.show', $categoria) }}">
                        <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                        <input type="hidden" name="precio_min" value="{{ request('precio_min') }}">
                        <input type="hidden" name="precio_max" value="{{ request('precio_max') }}">
                        <input type="hidden" name="stock" value="{{ request('stock') }}">

                        <select
                            name="orden"
                            onchange="this.form.submit()"
                            class="h-10 rounded-xl border border-slate-200 px-3 text-sm">
                            <option value="latest" {{ request('orden') == 'latest' ? 'selected' : '' }}>
                                Más recientes
                            </option>
                            <option value="precio_asc" {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>
                                Menor precio
                            </option>
                            <option value="precio_desc" {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>
                                Mayor precio
                            </option>
                            <option value="nombre_asc" {{ request('orden') == 'nombre_asc' ? 'selected' : '' }}>
                                Nombre A-Z
                            </option>
                        </select>
                    </form>
                </div>

                @if($productos->count())
                    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach($productos as $producto)
                            <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                                <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                                    <img
                                        src="{{ $producto->imagen_url }}"
                                        alt="{{ $producto->nombre }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    >

                                    @if(($producto->stock ?? 0) > 0)
                                        <span class="absolute top-3 right-3 rounded-full bg-emerald-500 px-3 py-1 text-xs font-bold text-white">
                                            Stock
                                        </span>
                                    @else
                                        <span class="absolute top-3 right-3 rounded-full bg-slate-700 px-3 py-1 text-xs font-bold text-white">
                                            Sin stock
                                        </span>
                                    @endif
                                </div>

                                <div class="p-5 space-y-4">
                                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                        {{ $producto->categoria->nombre ?? 'Categoría' }}
                                    </p>

                                    <h3 class="line-clamp-2 text-base font-bold text-slate-900">
                                        {{ $producto->nombre }}
                                    </h3>

                                    <p class="line-clamp-2 text-sm text-slate-500">
                                        {{ $producto->descripcion ?: 'Producto disponible en esta categoría.' }}
                                    </p>

                                    <div class="flex items-end justify-between gap-3">
                                        <p class="text-2xl font-black text-slate-900">
                                            ${{ number_format($producto->precio, 0, ',', '.') }}
                                        </p>

                                        <a
                                            href="{{ route('productos.show', $producto) }}"
                                            class="rounded-xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                                            Ver
                                        </a>
                                    </div>

                                    <form action="{{ route('carrito.agregar', $producto) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cantidad" value="1">

                                        <button
                                            type="submit"
                                            class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                                            Agregar al carrito
                                        </button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-10">
                        {{ $productos->links() }}
                    </div>
                @else
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm">
                        <h2 class="text-2xl font-black tracking-tight text-slate-900">
                            No hay productos en esta categoría
                        </h2>
                        <p class="mt-3 text-sm leading-7 text-slate-500 sm:text-base">
                            Probá ajustando los filtros o explorando otras categorías.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection