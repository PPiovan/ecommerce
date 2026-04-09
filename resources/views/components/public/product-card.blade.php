@props([
    'producto',
    'showCategory' => true,
    'showCartButton' => true,
])

@php
    $imagen = $producto->imagen_url
        ?? ($producto->imagen
            ? asset('storage/' . $producto->imagen)
            : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop');

    $tieneOferta = $producto->tiene_oferta ?? false;
    $precioBase = $producto->precio ?? 0;
    $precioFinal = $producto->precio_final ?? $precioBase;
    $descuentoLabel = $producto->descuento_label ?? 'Oferta';
    $stock = $producto->stock ?? 0;
@endphp

<article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
        <img
            src="{{ $imagen }}"
            alt="{{ $producto->nombre }}"
            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
        >

        @if($tieneOferta)
            <span class="absolute left-3 top-3 rounded-full bg-rose-500 px-3 py-1 text-xs font-bold text-white shadow-sm">
                {{ $descuentoLabel }}
            </span>
        @endif

        @if($stock > 0)
            <span class="absolute right-3 top-3 rounded-full bg-emerald-500 px-3 py-1 text-xs font-bold text-white shadow-sm">
                Stock
            </span>
        @else
            <span class="absolute right-3 top-3 rounded-full bg-slate-700 px-3 py-1 text-xs font-bold text-white shadow-sm">
                Sin stock
            </span>
        @endif
    </div>

    <div class="space-y-4 p-5">
        @if($showCategory)
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                {{ $producto->categoria->nombre ?? 'Categoría' }}
            </p>
        @endif

        <div>
            <h3 class="line-clamp-2 text-base font-bold text-slate-900">
                {{ $producto->nombre }}
            </h3>

            <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">
                {{ $producto->descripcion ?: 'Producto disponible en la tienda.' }}
            </p>
        </div>

        <div class="flex items-end justify-between gap-3">
            <div>
                @if($tieneOferta)
                    <p class="text-sm text-slate-400 line-through">
                        ${{ number_format($precioBase, 0, ',', '.') }}
                    </p>
                @endif

                <p class="text-2xl font-black text-slate-900">
                    ${{ number_format($precioFinal, 0, ',', '.') }}
                </p>
            </div>

            <a
                href="{{ route('productos.show', $producto) }}"
                class="rounded-xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                Ver
            </a>
        </div>

        @if($showCartButton)
            <form action="{{ route('carrito.agregar', $producto) }}" method="POST">
                @csrf
                <input type="hidden" name="cantidad" value="1">

                <button
                    type="submit"
                    class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Agregar al carrito
                </button>
            </form>
        @endif
    </div>
</article>