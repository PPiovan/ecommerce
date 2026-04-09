@extends('layouts.public')

@section('title', 'Ofertas')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <span class="inline-flex items-center rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-rose-600">
                        Ofertas
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        Productos en oferta
                    </h1>

                    <p class="mt-3 text-sm leading-7 text-slate-600 sm:text-base">
                        Descubrí promociones activas, precios rebajados y oportunidades destacadas dentro de la tienda.
                    </p>
                </div>

                <div class="rounded-2xl border border-rose-200 bg-rose-50 px-6 py-4 text-center">
                    <p class="text-lg font-black text-slate-900">
                        {{ $productos->total() }}
                    </p>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        En oferta
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        @if($productos->count())
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                @foreach($productos as $producto)
                    <x-public.product-card :producto="$producto" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $productos->links() }}
            </div>
        @else
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm">
                <h2 class="text-2xl font-black tracking-tight text-slate-900">
                    No hay ofertas activas
                </h2>

                <p class="mt-3 text-sm leading-7 text-slate-500 sm:text-base">
                    Cuando actives promociones desde el panel admin, se van a mostrar acá automáticamente.
                </p>

                <a
                    href="{{ route('productos.index') }}"
                    class="mt-6 inline-flex rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800">
                    Ver productos
                </a>
            </div>
        @endif
    </section>
@endsection