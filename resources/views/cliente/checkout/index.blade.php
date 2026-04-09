@extends('layouts.public')

@section('title', 'Checkout')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.22em] text-slate-500">
                        Checkout
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        Confirmá tu compra
                    </h1>

                    <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                        Revisá los productos de tu pedido, elegí cómo querés pagar y finalizá la compra de forma segura.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('carrito.index') }}"
                       class="inline-flex items-center justify-center rounded-full border border-slate-200 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                        Volver al carrito
                    </a>

                    <a href="{{ route('productos.index') }}"
                       class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800">
                        Seguir comprando
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-10 sm:py-12">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <div class="space-y-6 lg:col-span-8">
                @if(session('error'))
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <div class="flex flex-col gap-3 border-b border-slate-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h2 class="text-2xl font-black tracking-tight text-slate-950">
                                Productos del pedido
                            </h2>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Verificá cantidades, precios y subtotales antes de continuar.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 px-4 py-3">
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                                Items
                            </p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                {{ count($items) }} producto(s)
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        @foreach($items as $item)
                            <article class="flex flex-col gap-4 rounded-3xl border border-slate-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                                <div class="min-w-0">
                                    <p class="text-base font-bold text-slate-900">
                                        {{ $item['producto']->nombre }}
                                    </p>

                                    <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-slate-500">
                                        <span>Cantidad: <strong class="text-slate-700">{{ $item['cantidad'] }}</strong></span>
                                    </div>
                                </div>

                                <div class="text-left sm:text-right">
                                    <p class="text-sm text-slate-500">Precio unitario</p>
                                    <p class="text-sm font-semibold text-slate-900">
                                        ${{ number_format($item['precio_unitario'], 2, ',', '.') }}
                                    </p>
                                </div>

                                <div class="text-left sm:text-right">
                                    <p class="text-sm text-slate-500">Subtotal</p>
                                    <p class="text-base font-black text-slate-900">
                                        ${{ number_format($item['subtotal'], 2, ',', '.') }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>

            <aside class="space-y-6 lg:col-span-4">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="border-b border-slate-200 pb-5">
                        <h2 class="text-xl font-black tracking-tight text-slate-950">
                            Resumen de la compra
                        </h2>
                        <p class="mt-2 text-sm text-slate-500">
                            Elegí cómo querés pagar y confirmá tu pedido.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('cliente.checkout.store') }}" class="mt-5 space-y-6">
                        @csrf

                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Subtotal</span>
                                <span class="font-semibold text-slate-900">
                                    ${{ number_format($subtotal, 2, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Envío</span>
                                <span class="font-semibold text-slate-900">
                                    A coordinar
                                </span>
                            </div>

                            <div class="border-t border-slate-200 pt-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-semibold text-slate-600">Total</span>
                                    <span class="text-2xl font-black tracking-tight text-slate-950">
                                        ${{ number_format($total, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="mb-3 block text-sm font-semibold text-slate-700">
                                Método de pago
                            </label>

                            <div class="space-y-3">
                                <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-slate-300 hover:bg-slate-50">
                                    <input
                                        type="radio"
                                        name="metodo_pago"
                                        value="efectivo"
                                        class="mt-1 h-4 w-4 border-slate-300 text-slate-900 focus:ring-slate-400"
                                        @checked(old('metodo_pago') === 'efectivo')
                                    >

                                    <div>
                                        <p class="text-sm font-bold text-slate-900">
                                            Efectivo
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Pagás al retirar en el local o al coordinar la entrega.
                                        </p>
                                    </div>
                                </label>

                                <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-slate-300 hover:bg-slate-50">
                                    <input
                                        type="radio"
                                        name="metodo_pago"
                                        value="transferencia"
                                        class="mt-1 h-4 w-4 border-slate-300 text-slate-900 focus:ring-slate-400"
                                        @checked(old('metodo_pago') === 'transferencia')
                                    >

                                    <div>
                                        <p class="text-sm font-bold text-slate-900">
                                            Transferencia bancaria
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Te compartiremos los datos para realizar el pago.
                                        </p>
                                    </div>
                                </label>

                                <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-slate-300 hover:bg-slate-50">
                                    <input
                                        type="radio"
                                        name="metodo_pago"
                                        value="mercadopago"
                                        class="mt-1 h-4 w-4 border-slate-300 text-slate-900 focus:ring-slate-400"
                                        @checked(old('metodo_pago') === 'mercadopago')
                                    >

                                    <div>
                                        <p class="text-sm font-bold text-slate-900">
                                            Mercado Pago
                                            
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Vas a ser redirigido para completar el pago de forma segura.
                                        </p>
                                    </div>
                                </label>
                            </div>

                            @error('metodo_pago')
                                <p class="mt-3 text-sm font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="observaciones" class="mb-2 block text-sm font-semibold text-slate-700">
                                Observaciones
                            </label>

                            <textarea
                                id="observaciones"
                                name="observaciones"
                                rows="4"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                                placeholder="Ej: horario de retiro, detalle importante del pedido, etc."
                            >{{ old('observaciones') }}</textarea>

                            @error('observaciones')
                                <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-800">
                                Al confirmar tu compra, aceptás continuar con el proceso de pago y validación del pedido.
                            </p>
                        </div>

                        <button
                            type="submit"
                            class="inline-flex h-12 w-full items-center justify-center rounded-full bg-slate-900 px-6 text-sm font-bold text-white transition hover:bg-slate-800"
                        >
                            Confirmar compra
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </section>
@endsection