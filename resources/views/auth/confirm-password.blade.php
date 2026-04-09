@extends('layouts.auth')

@section('title', 'Confirmar contraseña')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-slate-50 px-4 py-10">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-black tracking-tight text-slate-950">
                Confirmar contraseña
            </h2>
            <p class="mt-2 text-sm leading-6 text-slate-500">
                Por seguridad, ingresá nuevamente tu contraseña para continuar.
            </p>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                        Contraseña
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-800 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200"
                    >
                    @error('password')
                        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="inline-flex h-12 w-full items-center justify-center rounded-full bg-slate-950 px-6 text-sm font-bold text-white transition hover:bg-slate-800"
                >
                    Confirmar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection