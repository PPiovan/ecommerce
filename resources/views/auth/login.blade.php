@extends('layouts.auth')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="grid min-h-screen lg:grid-cols-2">
        {{-- LADO IZQUIERDO --}}
        <div class="hidden lg:flex relative overflow-hidden bg-slate-950">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800"></div>
            <div class="absolute -left-24 top-24 h-72 w-72 rounded-full bg-cyan-500/10 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-indigo-500/10 blur-3xl"></div>

            <div class="relative z-10 flex h-full w-full flex-col justify-between p-12 text-white">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-slate-950 shadow-lg">
                        <span class="text-lg font-black">T</span>
                    </div>
                    <div>
                        <p class="text-lg font-black tracking-tight">Tecnotienda</p>
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Store</p>
                    </div>
                </a>

                <div class="max-w-xl">
                    <span class="inline-flex rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-slate-300">
                        Bienvenido
                    </span>

                    <h1 class="mt-6 text-5xl font-black leading-tight tracking-tight">
                        Ingresá a tu cuenta y seguí comprando sin vueltas.
                    </h1>

                    <p class="mt-5 max-w-lg text-base leading-8 text-slate-300">
                        Accedé a tu perfil, revisá tus pedidos, gestioná tus datos y disfrutá de una experiencia más rápida y personalizada.
                    </p>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-sm font-semibold">Compras rápidas</p>
                        <p class="mt-1 text-sm text-slate-400">Tus datos siempre listos.</p>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-sm font-semibold">Seguimiento</p>
                        <p class="mt-1 text-sm text-slate-400">Controlá tus pedidos fácil.</p>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-sm font-semibold">Más simple</p>
                        <p class="mt-1 text-sm text-slate-400">Todo en un solo lugar.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- LADO DERECHO --}}
        <div class="flex items-center justify-center bg-slate-50 px-4 py-10 sm:px-6 lg:px-10">
            <div class="w-full max-w-md">
                <div class="mb-8 text-center lg:text-left">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 lg:hidden">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-lg">
                            <span class="text-lg font-black">T</span>
                        </div>
                        <div class="text-left">
                            <p class="text-lg font-black tracking-tight text-slate-950">Tecnotienda</p>
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Store</p>
                        </div>
                    </a>

                    <h2 class="mt-6 text-3xl font-black tracking-tight text-slate-950">
                        Iniciar sesión
                    </h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Ingresá con tu correo y contraseña para acceder a tu cuenta.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                                Correo electrónico
                            </label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="tuemail@ejemplo.com"
                                class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                            >
                            @error('email')
                                <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="mb-2 flex items-center justify-between gap-3">
                                <label for="password" class="block text-sm font-semibold text-slate-700">
                                    Contraseña
                                </label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-slate-500 transition hover:text-slate-900">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Ingresá tu contraseña"
                                class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                            >
                            @error('password')
                                <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex items-center gap-3">
                            <input
                                type="checkbox"
                                name="remember"
                                class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400"
                            >
                            <span class="text-sm text-slate-600">Recordarme en este dispositivo</span>
                        </label>

                        <button
                            type="submit"
                            class="inline-flex h-12 w-full items-center justify-center rounded-full bg-slate-950 px-6 text-sm font-bold text-white transition hover:bg-slate-800"
                        >
                            Iniciar sesión
                        </button>
                    </form>

                    <div class="my-6 border-t border-slate-200"></div>

                    <div class="text-center">
                        <p class="text-sm text-slate-500">
                            ¿Todavía no tenés cuenta?
                        </p>
                        <a
                            href="{{ route('register') }}"
                            class="mt-3 inline-flex h-12 items-center justify-center rounded-full border border-slate-200 px-6 text-sm font-bold text-slate-800 transition hover:bg-slate-50"
                        >
                            Crear cuenta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection