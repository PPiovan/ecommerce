<header
    x-data="{
        mobileMenu: false,
        accountPanel: false,
        toggleAccountPanel() {
            this.accountPanel = !this.accountPanel
            if (this.accountPanel) this.mobileMenu = false
        }
    }"
    class="sticky top-0 z-50 border-b border-slate-200 bg-white"
>
    @php
        $cantidadCarrito = collect(session('carrito', []))->sum('cantidad');
    @endphp

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex min-h-[78px] items-center justify-between gap-4">
            {{-- IZQUIERDA --}}
            <div class="flex items-center gap-3 lg:gap-8">
                <button
                    @click="mobileMenu = true"
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl p-2 text-slate-700 hover:bg-slate-100 lg:hidden"
                    aria-label="Abrir menú"
                >
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm">
                        <span class="text-lg font-black">T</span>
                    </div>

                    <div class="hidden sm:block">
                        <p class="text-lg font-black tracking-tight text-slate-900">Tecnotienda Store</p>
                        <p class="text-xs text-slate-500">Tu vendedor de confianza</p>
                    </div>
                </a>

                <nav class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-slate-950">
                        Inicio
                    </a>
                    <a href="{{ route('productos.index') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-slate-950">
                        Tienda
                    </a>
                    <a href="{{ route('categorias.index') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-slate-950">
                        Categorías
                    </a>
                    <a href="{{ route('ofertas.index') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-slate-950">
                        Promociones
                    </a>
                </nav>
            </div>

            {{-- CENTRO --}}
            <div class="hidden flex-1 lg:block">
                <form action="{{ route('productos.index') }}" method="GET" class="mx-auto max-w-2xl">
                    <div class="relative">
                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            placeholder="Buscar productos, marcas y categorías..."
                            class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-4 text-sm text-slate-700 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                        >

                        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" />
                        </svg>
                    </div>
                </form>
            </div>

            {{-- DERECHA --}}
            <div class="flex items-center gap-2 sm:gap-3">
               <button
                    @click="toggleAccountPanel()"
                    type="button"
                    class="inline-flex items-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                >
                    Mi cuenta
                </button>
                <a href="{{ route('carrito.index') }}"
                   class="relative inline-flex h-11 items-center justify-center gap-2 rounded-2xl bg-slate-900 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386a1.5 1.5 0 0 1 1.465 1.175L5.73 7.5m0 0h13.59a1.5 1.5 0 0 1 1.46 1.84l-1.2 5.25a1.5 1.5 0 0 1-1.462 1.16H8.239a1.5 1.5 0 0 1-1.462-1.16L5.73 7.5Zm0 0L4.5 4.5M9 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm9 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>

                    <span class="hidden sm:inline">Carrito</span>

                    @if($cantidadCarrito > 0)
                        <span class="absolute -right-2 -top-2 inline-flex h-6 min-w-[1.5rem] items-center justify-center rounded-full bg-rose-500 px-1 text-xs font-bold text-white">
                            {{ $cantidadCarrito }}
                        </span>
                    @endif
                </a>
            </div>
        </div>

        {{-- BUSCADOR MOBILE --}}
        <div class="pb-4 lg:hidden">
            <form action="{{ route('productos.index') }}" method="GET">
                <div class="relative">
                    <input
                        type="text"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        placeholder="Buscar productos..."
                        class="h-11 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-4 text-sm text-slate-700 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                    >

                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" />
                    </svg>
                </div>
            </form>
        </div>
    </div>

    {{-- OVERLAY PANEL CUENTA --}}
        <div
            x-show="accountPanel"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="accountPanel = false"
            class="fixed inset-0 z-[90] bg-black/30"
        ></div>

    {{-- PANEL CUENTA --}}
    <aside
        x-show="accountPanel"
        x-cloak
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-200"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"
        class="fixed right-0 top-0 z-[100] h-screen w-full max-w-[380px] overflow-y-auto bg-white shadow-xl will-change-transform"
    >
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
            <h3 class="text-xl font-bold tracking-tight text-slate-900">Mi cuenta</h3>

            <button
                @click="accountPanel = false"
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-full text-slate-500 transition hover:bg-slate-100 hover:text-slate-900"
                aria-label="Cerrar panel"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="px-6 py-6">
            @auth
                <div class="mb-6 rounded-3xl bg-slate-50 p-5">
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-900 text-lg font-bold text-white">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">
                            <p class="truncate text-base font-bold text-slate-900">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="truncate text-sm text-slate-500">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                   @if (Route::has('profile.edit'))
                        <a href="{{ route('profile.edit') }}"
                        class="flex items-center justify-between rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-800 transition hover:bg-slate-50">
                            <span>Mi perfil</span>
                            <span>→</span>
                        </a>
                @endif
              <a href="{{ route('cliente.ventas.index') }}"
                class="flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-950">
                    <span>Mis compras</span>
                    <span>→</span>
                </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="flex w-full items-center justify-between rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-800 transition hover:bg-slate-50"
                        >
                            <span>Cerrar sesión</span>
                            <span class="text-slate-400">→</span>
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="mb-8 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.964 0a9 9 0 1 0-11.964 0m11.964 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>

                    <h4 class="text-lg font-bold text-slate-900">Ingresá a tu cuenta</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Comprá más rápido, guardá tus datos y seguí tus pedidos.
                    </p>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('login') }}"
                    class="flex items-center justify-center rounded-full bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-slate-800">
                        Iniciar sesión
                    </a>

                    @if(Route::has('register'))
                        <a href="{{ route('register') }}"
                        class="flex items-center justify-center rounded-full border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800 transition hover:bg-slate-50">
                            Crear cuenta
                        </a>
                    @endif
                </div>
            @endguest
        </div>
    </aside>

    {{-- OVERLAY MOBILE --}}
    <div
        x-show="mobileMenu"
        x-cloak
        x-transition.opacity
        @click="mobileMenu = false"
        class="fixed inset-0 z-[90] bg-black/40 lg:hidden"
    ></div>

    {{-- PANEL MOBILE --}}
    <aside
        x-show="mobileMenu"
        x-cloak
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed left-0 top-0 z-[100] h-screen w-[88%] max-w-sm overflow-y-auto border-r border-slate-200 bg-white shadow-2xl lg:hidden"
    >
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
            <div>
                <p class="text-base font-black text-slate-900">Tecnotienda</p>
                <p class="text-xs uppercase tracking-[0.22em] text-slate-400">Menú</p>
            </div>

            <button
                @click="mobileMenu = false"
                class="rounded-xl p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-800"
                type="button"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-5">
            <nav class="space-y-2">
                <a href="{{ route('home') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-100">Inicio</a>
                <a href="{{ route('productos.index') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-100">Tienda</a>
                <a href="{{ route('categorias.index') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-100">Categorías</a>
                <a href="{{ route('ofertas.index') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-100">Promociones</a>
                <a href="{{ route('carrito.index') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-100">Carrito</a>
            </nav>
        </div>
    </aside>
</header>