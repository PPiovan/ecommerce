@extends('layouts.admin')

@section('content')

@if(session('success'))
<div class="mb-6 admin-badge-success px-4 py-3 rounded-xl">
    {{ session('success') }}
</div>
@endif


{{-- FILTROS --}}
<div class="admin-card mb-6">

    <div class="admin-card-header">
        <h3 class="admin-card-title">Filtros</h3>
    </div>

    <div class="p-6">

        <form method="GET" action="{{ route('admin.productos.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="md:col-span-2">
                <label class="admin-label">Buscar</label>

                <input
                    type="text"
                    name="buscar"
                    value="{{ request('buscar') }}"
                    placeholder="Buscar por nombre o slug..."
                    class="admin-input"
                >
            </div>

            <div>
                <label class="admin-label">Categoría</label>

                <select name="categoria" class="admin-input">
                    <option value="">Todas</option>

                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="admin-label">Estado</label>

                <select name="activo" class="admin-input">
                    <option value="">Todos</option>
                    <option value="1" {{ request('activo') === '1' ? 'selected' : '' }}>Activos</option>
                    <option value="0" {{ request('activo') === '0' ? 'selected' : '' }}>Inactivos</option>
                </select>
            </div>

            <div class="md:col-span-4 flex items-center gap-3">

                <button type="submit" class="admin-btn-primary">
                    Filtrar
                </button>

                <a href="{{ route('admin.productos.index') }}" class="admin-btn-secondary">
                    Limpiar
                </a>

            </div>

        </form>

    </div>

</div>



{{-- TABLA DE PRODUCTOS --}}
<div class="admin-card">

    <div class="admin-card-header">

        <div>
            <h3 class="admin-card-title">Listado de productos</h3>
            <p class="admin-card-subtitle">Administrá los productos del sistema</p>
        </div>

        <a href="{{ route('admin.productos.create') }}" class="admin-btn-primary">
            Nuevo producto
        </a>

    </div>


    <div class="overflow-x-auto">

        <table class="admin-table">

            <thead class="admin-table-head">
                <tr>
                    <th class="px-6 py-4 text-left">ID</th>
                    <th class="px-6 py-4 text-left">Imagen</th>
                    <th class="px-6 py-4 text-left">Nombre</th>
                    <th class="px-6 py-4 text-left">Categoría</th>
                    <th class="px-6 py-4 text-left">Precio</th>
                    <th class="px-6 py-4 text-left">Oferta</th>
                    <th class="px-6 py-4 text-left">Stock</th>
                    <th class="px-6 py-4 text-left">Estado</th>
                    <th class="px-6 py-4 text-left">Acciones</th>
                </tr>
            </thead>

            <tbody>

            @forelse($productos as $producto)

                <tr class="admin-table-row">

                    <td class="px-6 py-4">{{ $producto->id }}</td>

                    <td class="px-6 py-4">
                        @if($producto->imagen)
                            <img
                                src="{{ asset('storage/' . $producto->imagen) }}"
                                class="w-14 h-14 rounded-lg object-cover border"
                            >
                        @else
                            <div class="w-14 h-14 rounded-lg bg-gray-100 border flex items-center justify-center text-xs text-gray-400">
                                Sin img
                            </div>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-medium">
                        {{ $producto->nombre }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $producto->categoria->nombre }}
                    </td>


                    {{-- PRECIO --}}
                    <td class="px-6 py-4">

                        @if($producto->ofertaActiva)

                            <div class="flex flex-col">

                                <span class="text-sm text-slate-400 line-through">
                                    ${{ number_format($producto->precio,2,',','.') }}
                                </span>

                                <span class="font-semibold text-green-600">
                                    ${{ number_format($producto->precio_final,2,',','.') }}
                                </span>

                            </div>

                        @else

                            ${{ number_format($producto->precio,2,',','.') }}

                        @endif

                    </td>



                    {{-- OFERTA --}}
                    <td class="px-6 py-4">

                        @if($producto->ofertaActiva)
                            <span class="admin-badge-success">
                                OFERTA
                            </span>
                        @endif

                    </td>



                    {{-- STOCK --}}
                    <td class="px-6 py-4">

                        @if($producto->stock <= 0)

                            <span class="admin-badge-danger">
                                Sin stock ({{ $producto->stock }})
                            </span>

                        @elseif($producto->stock <= 5)

                            <span class="inline-flex rounded-full bg-yellow-100 text-yellow-700 px-3 py-1 text-xs font-semibold">
                                Stock bajo ({{ $producto->stock }})
                            </span>

                        @else

                            <span class="admin-badge-success">
                                Stock OK ({{ $producto->stock }})
                            </span>

                        @endif

                    </td>



                    {{-- ESTADO --}}
                    <td class="px-6 py-4">

                        @if($producto->activo)
                            <span class="admin-badge-success">Activo</span>
                        @else
                            <span class="admin-badge-danger">Inactivo</span>
                        @endif

                    </td>



                    {{-- ACCIONES --}}
                    <td class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('admin.productos.edit', $producto) }}"
                                class="admin-btn-edit"
                            >
                                Editar
                            </a>

                            <form
                                action="{{ route('admin.productos.destroy', $producto) }}"
                                method="POST"
                                onsubmit="return confirm('¿Eliminar este producto?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="admin-btn-delete">
                                    Eliminar
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-slate-500">
                        No hay productos cargados todavía.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>


    <div class="px-6 py-4 border-t border-slate-200">
        {{ $productos->links() }}
    </div>

</div>

@endsection