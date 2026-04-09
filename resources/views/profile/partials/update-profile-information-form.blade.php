<section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="flex flex-col gap-3 border-b border-slate-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h2 class="text-2xl font-black tracking-tight text-slate-950">
                Datos personales
            </h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Editá tu nombre y tu correo electrónico para mantener tu cuenta actualizada.
            </p>
        </div>

        <div class="rounded-2xl bg-slate-50 px-4 py-3">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                Perfil
            </p>
            <p class="mt-1 text-sm font-semibold text-slate-900">
                Información básica
            </p>
        </div>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
            Tus datos se actualizaron correctamente.
        </div>
    @endif

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 grid gap-5 md:grid-cols-2">
        @csrf
        @method('patch')

        <div class="md:col-span-1">
            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                Nombre completo
            </label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
            >
            @error('name')
                <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-1">
            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                Correo electrónico
            </label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
            >
            @error('email')
                <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="md:col-span-2 rounded-2xl border border-amber-200 bg-amber-50 p-4">
                <p class="text-sm font-medium text-amber-800">
                    Tu correo todavía no está verificado.
                </p>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="mt-3">
                    @csrf
                </form>

                <button
                    form="send-verification"
                    class="mt-3 inline-flex items-center justify-center rounded-full border border-amber-300 px-4 py-2 text-sm font-bold text-amber-900 transition hover:bg-amber-100"
                >
                    Reenviar correo de verificación
                </button>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-3 text-sm font-medium text-emerald-700">
                        Te enviamos un nuevo enlace de verificación.
                    </p>
                @endif
            </div>
        @endif

        <div class="md:col-span-2 pt-2">
            <button
                type="submit"
                class="inline-flex h-12 items-center justify-center rounded-full bg-slate-950 px-6 text-sm font-bold text-white transition hover:bg-slate-800"
            >
                Guardar cambios
            </button>
        </div>
    </form>
</section>