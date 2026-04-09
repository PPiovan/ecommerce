<section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="flex flex-col gap-3 border-b border-slate-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h2 class="text-2xl font-black tracking-tight text-slate-950">
                Seguridad
            </h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Cambiá tu contraseña para mantener protegida tu cuenta.
            </p>
        </div>

        <div class="rounded-2xl bg-slate-50 px-4 py-3">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                Acceso
            </p>
            <p class="mt-1 text-sm font-semibold text-slate-900">
                Contraseña
            </p>
        </div>
    </div>

    @if (session('status') === 'password-updated')
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
            Tu contraseña se actualizó correctamente.
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="mt-6 grid gap-5 md:grid-cols-2">
        @csrf
        @method('put')

        <div class="md:col-span-2">
            <label for="update_password_current_password" class="mb-2 block text-sm font-semibold text-slate-700">
                Contraseña actual
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
            >
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-1">
            <label for="update_password_password" class="mb-2 block text-sm font-semibold text-slate-700">
                Nueva contraseña
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
            >
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-1">
            <label for="update_password_password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">
                Confirmar nueva contraseña
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
            >
        </div>

        <div class="md:col-span-2 pt-2">
            <button
                type="submit"
                class="inline-flex h-12 items-center justify-center rounded-full bg-slate-950 px-6 text-sm font-bold text-white transition hover:bg-slate-800"
            >
                Actualizar contraseña
            </button>
        </div>
    </form>
</section>