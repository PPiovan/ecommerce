@extends('layouts.public')

@section('title', 'Categorías')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                    Categorías
                </span>

                <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                    Explorá por categorías
                </h1>

                <p class="mt-3 text-sm leading-7 text-slate-600 sm:text-base">
                    Organizamos los productos para que encontrar lo que buscás sea más simple, rápido y visual.
                </p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        @if($categorias->count())
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($categorias as $categoria)
                    <a href="{{ route('categorias.show', $categoria) }}"
                       class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-700 transition group-hover:bg-slate-900 group-hover:text-white">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 3.75v3m10.5-3v3m-12 4.5h13.5a1.5 1.5 0 0 1 1.5 1.5v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V12.75a1.5 1.5 0 0 1 1.5-1.5Z" />
                            </svg>
                        </div>

                        <div class="space-y-3">
                            <h2 class="text-lg font-black tracking-tight text-slate-900">
                                {{ $categoria->nombre }}
                            </h2>

                            @if(!empty($categoria->descripcion))
                                <p class="line-clamp-3 text-sm leading-6 text-slate-600">
                                    {{ $categoria->descripcion }}
                                </p>
                            @else
                                <p class="line-clamp-3 text-sm leading-6 text-slate-500">
                                    Explorá todos los productos disponibles dentro de esta categoría.
                                </p>
                            @endif
                        </div>

                        <div class="mt-5 flex items-center justify-between">
                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700">
                                {{ $categoria->productos_count ?? 0 }} productos
                            </span>

                            <span class="text-sm font-semibold text-slate-700 transition group-hover:text-slate-900">
                                Ver más
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $categorias->links() }}
            </div>
        @else
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm">
                <h2 class="text-2xl font-black tracking-tight text-slate-900">
                    No hay categorías disponibles
                </h2>
                <p class="mt-3 text-sm leading-7 text-slate-500 sm:text-base">
                    Cuando cargues categorías en el panel admin, van a aparecer acá automáticamente.
                </p>
            </div>
        @endif
    </section>
@endsection