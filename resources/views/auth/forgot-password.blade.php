@extends('layouts.auth')

@section('title', 'Recuperar contraseña')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-slate-50 px-4 py-10">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-lg">
                    <span class="text-lg font-black">T</span>
                </div>
                <div class="text-left">
                    <p class="text-lg font-black tracking-tight text-slate-950">Tecnotienda</p>
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Store</p>
                </div>
            </a>

            <h2 class="mt-6 text-3xl font-black tracking-tight text-slate-950">
                Recuperar contraseña
            </h2>
            <p class="mt-2 text-sm leading-6 text-slate-500">
                Te enviaremos un enlace para restablecer tu contraseña.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
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
                        class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                    >
                    @error('email')
                        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="inline-flex h-12 w-full items-center justify-center rounded-full bg-slate-950 px-6 text-sm font-bold text-white transition hover:bg-slate-800"
                >
                    Enviar enlace de recuperación
                </button>
            </form>
        </div>
    </div>
</div>
@endsection