<nav class="border-b border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-3 text-sm font-semibold text-slate-600">
            <a href="{{ route('home') }}"
               class="whitespace-nowrap rounded-xl px-4 py-2 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('home') ? 'bg-slate-900 text-white hover:bg-slate-900 hover:text-white' : '' }}">
                Inicio
            </a>

            <a href="#destacados"
               class="whitespace-nowrap rounded-xl px-4 py-2 transition hover:bg-slate-100 hover:text-slate-900">
                Destacados
            </a>

            <a href="#categorias"
               class="whitespace-nowrap rounded-xl px-4 py-2 transition hover:bg-slate-100 hover:text-slate-900">
                Categorías
            </a>

            <a href="#beneficios"
               class="whitespace-nowrap rounded-xl px-4 py-2 transition hover:bg-slate-100 hover:text-slate-900">
                Beneficios
            </a>

            <a href="#contacto"
               class="whitespace-nowrap rounded-xl px-4 py-2 transition hover:bg-slate-100 hover:text-slate-900">
                Contacto
            </a>
        </div>
    </div>
</nav>