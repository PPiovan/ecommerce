<footer id="contacto" class="mt-16 border-t border-slate-200 bg-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 lg:grid-cols-4 lg:px-8">
        <div class="lg:col-span-2">
            <div class="mb-4 flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white">
                    <span class="text-lg font-black">M</span>
                </div>

                <div>
                    <p class="text-lg font-black tracking-tight text-slate-900">MiTienda</p>
                    <p class="text-sm text-slate-500">Frente moderno, limpio y preparado para vender</p>
                </div>
            </div>

            <p class="max-w-xl text-sm leading-7 text-slate-600">
                Una tienda online con una estética profesional, ideal para mostrar productos, promociones y generar confianza desde el primer vistazo.
            </p>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-slate-900">Secciones</h4>
            <ul class="space-y-3 text-sm text-slate-600">
                <li><a href="{{ route('home') }}" class="transition hover:text-slate-900">Inicio</a></li>
                <li><a href="#destacados" class="transition hover:text-slate-900">Destacados</a></li>
                <li><a href="#categorias" class="transition hover:text-slate-900">Categorías</a></li>
                <li><a href="#beneficios" class="transition hover:text-slate-900">Beneficios</a></li>
            </ul>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-slate-900">Contacto</h4>
            <ul class="space-y-3 text-sm text-slate-600">
                <li>Santa Fe, Argentina</li>
                <li>info@mitienda.com</li>
                <li>+54 9 3400 000000</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-slate-200">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-5 text-sm text-slate-500 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <p>© {{ date('Y') }} MiTienda. Todos los derechos reservados.</p>
            <p>Desarrollado con Laravel + Tailwind</p>
        </div>
    </div>
</footer>