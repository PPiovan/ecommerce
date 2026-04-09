@extends('layouts.public')

@section('title', 'Productos')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                        Catálogo
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        Explorá nuestros productos
                    </h1>

                    <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                        Encontrá lo que buscás rápido, fácil y con una experiencia visual profesional.
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
                <form action="{{ route('productos.index') }}" method="GET" class="space-y-6">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="text-lg font-black text-slate-900">
                            Filtros
                        </h2>

                        <a href="{{ route('productos.index') }}"
                           class="text-sm font-semibold text-slate-500 transition hover:text-slate-900">
                            Limpiar
                        </a>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Buscar
                        </label>

                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            placeholder="Nombre del producto..."
                            class="h-11 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                        >
                    </div>

                    <div>
                        <p class="mb-3 text-sm font-semibold text-slate-700">
                            Categorías
                        </p>

                        <div class="space-y-2">
                            @foreach($categorias as $categoria)
                                <label class="flex items-center gap-3 text-sm text-slate-600">
                                    <input
                                        type="checkbox"
                                        name="categoria[]"
                                        value="{{ $categoria->id }}"
                                        {{ in_array($categoria->id, request('categoria', [])) ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-slate-300"
                                    >
                                    <span>{{ $categoria->nombre }}</span>
                                </label>
                            @endforeach
                        </div>
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
                                class="h-11 rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                            >

                            <input
                                type="number"
                                name="precio_max"
                                value="{{ request('precio_max') }}"
                                placeholder="Max"
                                class="h-11 rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
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
                                    {{ request('stock') === null || request('stock') === '' ? 'checked' : '' }}
                                    class="h-4 w-4"
                                >
                                <span>Todos</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <p class="mb-3 text-sm font-semibold text-slate-700">
                            Promociones
                        </p>

                        <label class="flex items-center gap-3 text-sm text-slate-600">
                            <input
                                type="checkbox"
                                name="solo_ofertas"
                                value="1"
                                {{ request('solo_ofertas') == '1' ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-slate-300"
                            >
                            <span>Solo productos en oferta</span>
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800">
                        Aplicar filtros
                    </button>
                </form>
            </aside>

            <div>
                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-600">
                        Mostrando {{ $productos->count() }} de {{ $productos->total() }} productos
                    </p>

                    <form method="GET" action="{{ route('productos.index') }}">
                        <input type="hidden" name="buscar" value="{{ request('buscar') }}">

                        @foreach(request('categoria', []) as $cat)
                            <input type="hidden" name="categoria[]" value="{{ $cat }}">
                        @endforeach

                        <input type="hidden" name="precio_min" value="{{ request('precio_min') }}">
                        <input type="hidden" name="precio_max" value="{{ request('precio_max') }}">
                        <input type="hidden" name="stock" value="{{ request('stock') }}">
                        <input type="hidden" name="solo_ofertas" value="{{ request('solo_ofertas') }}">

                        <select
                            name="orden"
                            onchange="this.form.submit()"
                            class="h-10 rounded-xl border border-slate-200 bg-white px-3 text-sm outline-none transition focus:border-slate-400 focus:ring-4 focus:ring-slate-200">
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

                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse($productos as $producto)
                        <x-public.product-card :producto="$producto" />
                    @empty
                        <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm">
                            <h3 class="text-xl font-bold text-slate-900">
                                No hay productos
                            </h3>

                            <p class="mt-2 text-slate-500">
                                No encontramos productos con los filtros seleccionados.
                            </p>

                            <a
                                href="{{ route('productos.index') }}"
                                class="mt-6 inline-flex rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800">
                                Ver todo el catálogo
                            </a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection