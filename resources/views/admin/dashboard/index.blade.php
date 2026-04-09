@extends('layouts.admin')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="admin-card p-5">
            <p class="admin-card-subtitle">Ventas del día</p>
            <h3 class="mt-2 text-3xl font-bold text-slate-900">$120.000</h3>
        </div>

        <div class="admin-card p-5">
            <p class="admin-card-subtitle">Pedidos pendientes</p>
            <h3 class="mt-2 text-3xl font-bold text-slate-900">18</h3>
        </div>

        <div class="admin-card p-5">
            <p class="admin-card-subtitle">Productos con stock bajo</p>
            <h3 class="mt-2 text-3xl font-bold text-slate-900">7</h3>
        </div>

        <div class="admin-card p-5">
            <p class="admin-card-subtitle">Caja actual</p>
            <h3 class="mt-2 text-3xl font-bold text-slate-900">$85.400</h3>
        </div>

    </div>


    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2 admin-card p-6">
            <h3 class="admin-card-title mb-4">Actividad reciente</h3>

            <div class="space-y-4">

                <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                    <div>
                        <p class="font-medium text-slate-900">Nuevo pedido recibido</p>
                        <p class="text-sm text-slate-500">Pedido #0001</p>
                    </div>
                    <span class="text-sm text-slate-400">Hace 5 min</span>
                </div>

                <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                    <div>
                        <p class="font-medium text-slate-900">Producto actualizado</p>
                        <p class="text-sm text-slate-500">iPhone 13 128GB</p>
                    </div>
                    <span class="text-sm text-slate-400">Hace 20 min</span>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-slate-900">Cierre de caja realizado</p>
                        <p class="text-sm text-slate-500">Sucursal principal</p>
                    </div>
                    <span class="text-sm text-slate-400">Hace 1 hora</span>
                </div>

            </div>
        </div>


        <div class="admin-card p-5">
            <h3 class="admin-card-title mb-4">Accesos rápidos</h3>

            <div class="space-y-3">
                <a href="{{ route('admin.productos.create') }}"
                   class="block w-full rounded-xl bg-slate-900 text-white px-4 py-3 text-center transition hover:bg-slate-800">
                    Crear producto
                </a>

                <a href="#"
                   class="block w-full rounded-xl bg-slate-100 text-slate-800 px-4 py-3 text-center transition hover:bg-slate-200">
                    Ver pedidos
                </a>

                <a href="#"
                   class="block w-full rounded-xl bg-slate-100 text-slate-800 px-4 py-3 text-center transition hover:bg-slate-200">
                    Control de caja
                </a>
            </div>
        </div>

    </div>

@endsection