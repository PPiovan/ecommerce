<!-- <section x-data="{ open: false }" class="rounded-[2rem] border border-rose-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="flex flex-col gap-3 border-b border-rose-100 pb-6 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h2 class="text-2xl font-black tracking-tight text-slate-950">
                Zona sensible
            </h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Si eliminás tu cuenta, esta acción será definitiva y no vas a poder recuperar tus datos.
            </p>
        </div>

        <div class="rounded-2xl bg-rose-50 px-4 py-3">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-rose-400">
                Precaución
            </p>
            <p class="mt-1 text-sm font-semibold text-rose-700">
                Acción irreversible
            </p>
        </div>
    </div>

    <div class="mt-6">
        <button
            type="button"
            @click="open = true"
            class="inline-flex h-12 items-center justify-center rounded-full bg-rose-600 px-6 text-sm font-bold text-white transition hover:bg-rose-700"
        >
            Eliminar cuenta
        </button>
    </div>

    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[120] flex items-center justify-center bg-black/50 px-4"
    >
        <div
            x-show="open"
            x-transition
            @click.away="open = false"
            class="w-full max-w-md rounded-[2rem] bg-white p-6 shadow-2xl"
        >
            <h3 class="text-2xl font-black tracking-tight text-slate-950">
                Confirmar eliminación
            </h3>

            <p class="mt-3 text-sm leading-6 text-slate-500">
                Ingresá tu contraseña actual para confirmar que querés eliminar tu cuenta.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-4">
                @csrf
                @method('delete')

                <div>
                    <label for="delete_password" class="mb-2 block text-sm font-semibold text-slate-700">
                        Contraseña actual
                    </label>
                    <input
                        id="delete_password"
                        name="password"
                        type="password"
                        placeholder="Ingresá tu contraseña"
                        class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                    >
                    @error('password')
                        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <button
                        type="button"
                        @click="open = false"
                        class="inline-flex h-12 flex-1 items-center justify-center rounded-full border border-slate-200 px-5 text-sm font-bold text-slate-800 transition hover:bg-slate-50"
                    >
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="inline-flex h-12 flex-1 items-center justify-center rounded-full bg-rose-600 px-5 text-sm font-bold text-white transition hover:bg-rose-700"
                    >
                        Sí, eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</section> -->