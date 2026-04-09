@extends('layouts.auth')

@section('title', 'Verificar correo')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-slate-50 px-4 py-10">
    <div class="w-full max-w-md rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        <h2 class="text-3xl font-black tracking-tight text-slate-950">
            Verificá tu correo
        </h2>

        <p class="mt-4 text-sm leading-6 text-slate-500">
            Antes de continuar, revisá tu correo electrónico y hacé clic en el enlace de verificación que te enviamos.
            Si no lo recibiste, podés solicitar otro.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                Te enviamos un nuevo enlace de verificación.
            </div>
        @endif

        <div class="mt-6 space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button
                    type="submit"
                    class="inline-flex h-12 w-full items-center justify-center rounded-full bg-slate-950 px-6 text-sm font-bold text-white transition hover:bg-slate-800"
                >
                    Reenviar correo de verificación
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="inline-flex h-12 w-full items-center justify-center rounded-full border border-slate-200 px-6 text-sm font-bold text-slate-800 transition hover:bg-slate-50"
                >
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</div>
@endsection