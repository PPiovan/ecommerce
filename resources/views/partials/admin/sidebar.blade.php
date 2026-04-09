<aside class="admin-sidebar">
    <div class="admin-sidebar-header">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h1 class="text-lg font-extrabold tracking-wide uppercase text-slate-800 dark:text-white">
                   <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-800 truncate dark:text-slate-100">
                                {{ auth()->user()->name ?? 'Admin' }}
                            </p>

                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ auth()->user()?->getRoleNames()->first() ?? 'Sin rol' }}
                            </p>
                        </div>
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Panel de control
                </p>
            </div>

            <button
                @click="toggle()"
                class="relative inline-flex h-6 w-11 items-center rounded-full bg-slate-300 transition dark:bg-slate-700"
            >
                <span
                    class="inline-block h-4 w-4 transform rounded-full bg-white transition"
                    :class="dark ? 'translate-x-6' : 'translate-x-1'"
                ></span>
            </button>
        </div>
    </div>

    <div class="admin-sidebar-section-title">
        Navegación
    </div>

    <nav class="admin-sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
           class="admin-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'admin-sidebar-link-active' : 'admin-sidebar-link-default' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="admin-sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5M4.5 9.75V20.25h15V9.75" />
            </svg>
            <span>Inicio</span>
        </a>

        <a href="{{ route('admin.categorias.index') }}"
           class="admin-sidebar-link {{ request()->routeIs('admin.categorias.*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link-default' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="admin-sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75h15m-15 5.25h15m-15 5.25h15" />
            </svg>
            <span>Categorías</span>
        </a>
                <a href="{{ route('admin.roles.index') }}"
        class="admin-sidebar-link {{ request()->routeIs('admin.roles.*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link-default' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="admin-sidebar-icon"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8">

                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 15.75a6.75 6.75 0 100-13.5 6.75 6.75 0 000 13.5z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 21a9.75 9.75 0 0119.5 0"/>
            </svg>

            <span>Roles</span>
        </a>

        <a href="{{ route('admin.productos.index') }}"
           class="admin-sidebar-link {{ request()->routeIs('admin.productos.*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link-default' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="admin-sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5L12 3 3.75 7.5M20.25 7.5V16.5L12 21M20.25 7.5L12 12M3.75 7.5L12 12M3.75 7.5V16.5L12 21M12 12V21" />
            </svg>
            <span>Productos</span>
        </a>

        <a href="{{ route('admin.inventario.index') }}"
           class="admin-sidebar-link {{ request()->routeIs('admin.inventario.*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link-default' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="admin-sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5v10.5H3.75V6.75zM7.5 10.5h9M7.5 13.5h6" />
            </svg>
            <span>Inventario</span>
        </a>

       <a href="{{ route('admin.ofertas.index') }}"
            class="admin-sidebar-link {{ request()->routeIs('admin.ofertas.*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link-default' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="admin-sidebar-icon"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 3h5.25a2.25 2.25 0 011.591.659l5 5a2.25 2.25 0 010 3.182l-6.909 6.909a2.25 2.25 0 01-3.182 0l-6.909-6.91a2.25 2.25 0 010-3.181l5-5A2.25 2.25 0 017.5 3z"/>
                    <circle cx="9.75" cy="8.25" r="1.125"/>
                </svg>

                <span>Ofertas</span>
            </a>
            <a href="{{ route('admin.usuarios.index') }}"
                class="admin-sidebar-link {{ request()->routeIs('admin.usuarios.*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link-default' }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="admin-sidebar-icon"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m0-4a4 4 0 100-8 4 4 0 000 8zm8 4a4 4 0 10-4-4 4 4 0 004 4z"/>
                    </svg>

                    <span>Usuarios</span>
                </a>
        
                <a href="{{ route('admin.ventas.index') }}"
                    class="admin-sidebar-link {{ request()->routeIs('admin.ventas.*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link-default' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="admin-sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5v10.5H3.75V6.75zM7.5 10.5h9M7.5 13.5h6" />
                        </svg>
                        <span>Ventas</span>
                    </a>

        <a href="#"
           class="admin-sidebar-link admin-sidebar-link-default">
            <svg xmlns="http://www.w3.org/2000/svg" class="admin-sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5v10.5H3.75V6.75zM7.5 10.5h9" />
            </svg>
            <span>Pedidos</span>
        </a>

        <div class="px-3 pt-5 pb-2">
            <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">
                Ajustes
            </p>
        </div>

        <a href="#"
           class="admin-sidebar-link admin-sidebar-link-default">
            <svg xmlns="http://www.w3.org/2000/svg" class="admin-sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h3m-7.184 2.25l1.06-1.837m10.248 0l1.06 1.837M6 10.5v3m12-3v3m-1.124 4.413l-1.06 1.837m-8.632 0l-1.06-1.837M10.5 18h3M12 15.75A3.75 3.75 0 1012 8.25a3.75 3.75 0 000 7.5z" />
            </svg>
            <span>Configuración</span>
        </a>
    </nav>

    <div class="admin-sidebar-footer">

        <div class="admin-user-card">
            <div class="admin-user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>

            <div class="min-w-0">
                <p class="text-sm font-semibold text-slate-800 truncate dark:text-slate-100">
                    {{ auth()->user()->name ?? 'Admin' }}
                </p>

                <p class="text-xs text-slate-500 dark:text-slate-400">
                    {{ auth()->user()?->getRoleNames()->first() ?? 'Sin rol' }}
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf

            <button type="submit"
                class="w-full flex items-center justify-center gap-2 rounded-xl bg-red-100 text-red-700 px-4 py-2.5 text-sm font-medium hover:bg-red-200 transition
                dark:bg-red-900 dark:text-red-200 dark:hover:bg-red-800">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>

                Cerrar sesión
            </button>
        </form>

    </div>
</aside>