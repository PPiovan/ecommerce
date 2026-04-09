@extends('layouts.public')

@section('title', 'Mi cuenta')

@section('content')
    <section class="bg-slate-50 py-10 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-12">
                {{-- SIDEBAR --}}
                <aside class="xl:col-span-4 2xl:col-span-3">
                    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                        <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800 px-6 py-8 text-white">
                            <div class="flex items-center gap-4">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/10 text-xl font-black text-white ring-4 ring-white/10">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-lg font-black">
                                        {{ $user->name }}
                                    </p>
                                    <p class="truncate text-sm text-slate-300">
                                        {{ $user->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="space-y-3">
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                                        Estado
                                    </p>
                                    <p class="mt-1 text-sm font-semibold text-slate-900">
                                        Cuenta activa
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                                        Miembro desde
                                    </p>
                                    <p class="mt-1 text-sm font-semibold text-slate-900">
                                        {{ optional($user->created_at)->format('d/m/Y') }}
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">
                                        Correo
                                    </p>
                                    <p class="mt-1 break-all text-sm font-semibold text-slate-900">
                                        {{ $user->email }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 border-t border-slate-200 pt-6">
                                <nav class="space-y-2">
                                    <a href="#datos"
                                       class="flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-950">
                                        <span>Datos personales</span>
                                        <span>→</span>
                                    </a>

                                    <a href="#seguridad"
                                       class="flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-950">
                                        <span>Seguridad</span>
                                        <span>→</span>
                                    </a>

                                    <a href="#zona-peligrosa"
                                       class="flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold text-rose-600 transition hover:bg-rose-50">
                                        <span>Eliminar cuenta</span>
                                        <span>→</span>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- CONTENIDO --}}
                <div class="xl:col-span-8 2xl:col-span-9">
                    <div class="space-y-6">
                        <div id="datos">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <div id="seguridad">
                            @include('profile.partials.update-password-form')
                        </div>

                        <div id="zona-peligrosa">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection