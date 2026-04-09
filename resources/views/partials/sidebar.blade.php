<aside class="w-72 min-h-screen bg-white border-r border-slate-200 flex flex-col shadow-sm">
    {{-- Header --}}
    <div class="px-6 py-5 border-b border-slate-100">
        <div class="flex items-center justify-between">
            <h1 class="text-4xl font-extrabold tracking-tight text-blue-700">
                ADMIN
            </h1>

            {{-- Toggle visual --}}
            <div class="flex items-center gap-3 text-slate-400">
                <button class="hover:text-slate-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v1.5m0 15V21m9-9h-1.5M4.5 12H3m15.364 6.364-1.06-1.06M6.696 6.696l-1.06-1.06m12.728 0-1.06 1.06M6.696 17.304l-1.06 1.06M12 16a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                </button>

                <div class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-blue-600 transition"></div>
                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                </div>

                <button class="hover:text-slate-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.752 15.002A9.718 9.718 0 0118 15.75 9.75 9.75 0 018.25 6c0-1.33.266-2.598.748-3.752A9.753 9.753 0 1021.752 15z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <div class="flex-1 overflow-y-auto px-4 py-6">
        <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-4">
            Menu
        </p>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-medium transition
               {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 10.5L12 3l9 7.5M4.5 9.75V20.25h15V9.75" />
                </svg>
                <span>Inicio</span>
            </a>

            <a href="{{ route('admin.roles.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-medium transition
               {{ request()->routeIs('admin.roles.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 7.5A2.25 2.25 0 1112 7.5a2.25 2.25 0 014.5 0zM19.5 20.25a7.5 7.5 0 00-15 0" />
                </svg>
                <span>Roles</span>
            </a>

            <a href="{{ route('admin.usuarios.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-medium transition
               {{ request()->routeIs('admin.usuarios.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 01-3 .497 9.38 9.38 0 01-3-.497M6.75 7.5a5.25 5.25 0 1110.5 0 5.25 5.25 0 01-10.5 0z" />
                </svg>
                <span>Usuarios</span>
            </a>

            <a href="{{ route('admin.categorias.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-medium transition
               {{ request()->routeIs('admin.categorias.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
                <span>Categorías</span>
            </a>

            <a href="{{ route('admin.productos.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-medium transition
               {{ request()->routeIs('admin.productos.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 7.5L12 3 3.75 7.5M20.25 7.5V16.5L12 21M20.25 7.5L12 12M3.75 7.5V16.5L12 21M3.75 7.5L12 12M12 12V21" />
                </svg>
                <span>Productos</span>
            </a>

            <a href="{{ route('admin.pedidos.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-medium transition
               {{ request()->routeIs('admin.pedidos.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5v10.5H3.75V6.75zM7.5 17.25v1.5m9-1.5v1.5M7.5 10.5h9" />
                </svg>
                <span>Pedidos</span>
            </a>
        </nav>

        {{-- Ajustes --}}
        <div class="mt-8">
            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-4">
                Ajustes
            </p>

            <nav class="space-y-2">
                <a href="{{ route('admin.configuracion.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-medium transition
                   {{ request()->routeIs('admin.configuracion.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h3m-7.184 2.25l1.06-1.837m10.248 0l1.06 1.837M6 10.5v3m12-3v3m-1.124 4.413l-1.06 1.837m-8.632 0l-1.06-1.837M10.5 18h3M12 15.75A3.75 3.75 0 1012 8.25a3.75 3.75 0 000 7.5z" />
                    </svg>
                    <span>Configuración</span>
                </a>
            </nav>
        </div>
    </div>

    {{-- Footer user --}}
    <div class="border-t border-slate-100 px-4 py-4">
        <button class="w-full flex items-center justify-between rounded-xl px-3 py-3 hover:bg-slate-100 transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="text-left">
                    <p class="text-sm font-semibold text-slate-800">
                        {{ auth()->user()->name ?? 'Administrador' }}
                    </p>
                    <p class="text-xs text-slate-500">
                        {{ auth()->user()->email ?? 'admin@email.com' }}
                    </p>
                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25L12 15.75 4.5 8.25" />
            </svg>
        </button>
    </div>
</aside>