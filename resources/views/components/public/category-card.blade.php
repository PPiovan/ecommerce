@props(['producto'])

@php
    $precioOriginal = $producto->precio ?? 0;
    $precioFinal = $producto->precio_final ?? $precioOriginal;
    $tieneOferta = $precioFinal < $precioOriginal;
    $imagen = $producto->imagen_url ?? asset('images/placeholder-product.png');
@endphp

<div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
    <a href="{{ route('productos.show', $producto) }}" class="block">
        <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
            <img
                src="{{ $imagen }}"
                alt="{{ $producto->nombre }}"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
            >

            @if($tieneOferta)
                <span class="absolute left-3 top-3 rounded-full bg-rose-500 px-3 py-1 text-xs font-bold text-white shadow-sm">
                    Oferta
                </span>
            @endif

            @if(($producto->cantidad ?? 0) > 0)
                <span class="absolute right-3 top-3 rounded-full bg-emerald-500 px-3 py-1 text-xs font-bold text-white shadow-sm">
                    Stock
                </span>
            @else
                <span class="absolute right-3 top-3 rounded-full bg-slate-700 px-3 py-1 text-xs font-bold text-white shadow-sm">
                    Sin stock
                </span>
            @endif
        </div>
    </a>

    <div class="space-y-4 p-5">
        @if(!empty($producto->categoria?->nombre))
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                {{ $producto->categoria->nombre }}
            </p>
        @endif

        <div>
            <a href="{{ route('productos.show', $producto) }}"
               class="line-clamp-2 text-base font-bold text-slate-900 transition hover:text-slate-700">
                {{ $producto->nombre }}
            </a>

            @if(!empty($producto->descripcion))
                <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">
                    {{ $producto->descripcion }}
                </p>
            @endif
        </div>

        <div class="flex items-end justify-between gap-3">
            <div>
                @if($tieneOferta)
                    <p class="text-sm text-slate-400 line-through">
                        ${{ number_format($precioOriginal, 0, ',', '.') }}
                    </p>
                @endif

                <p class="text-2xl font-black tracking-tight text-slate-900">
                    ${{ number_format($precioFinal, 0, ',', '.') }}
                </p>
            </div>

            <a href="{{ route('productos.show', $producto) }}"
               class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                Ver más
            </a>
        </div>
    </div>
</div>