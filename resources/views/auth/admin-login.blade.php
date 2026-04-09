<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-2">
                Ingreso administrativo
            </h1>

            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
                Acceso exclusivo para empleados y administradores.
            </p>

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        Contraseña
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input id="remember" type="checkbox" name="remember" class="rounded border-slate-300">
                    <label for="remember" class="text-sm text-slate-600 dark:text-slate-400">
                        Recordarme
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                >
                    Ingresar al panel
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>