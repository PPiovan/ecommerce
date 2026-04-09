<?php

namespace App\Http\Controllers\Admin;

use App\Models\Producto;
use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Producto\StoreProductoRequest;
use App\Http\Requests\Admin\Producto\UpdateProductoRequest;

class ProductoController extends Controller
{
    public function index()
        {
           $query = Producto::with(['categoria', 'ofertaActiva']);

            if (request('buscar')) {
                $query->where(function ($q) {
                    $q->where('nombre', 'like', '%' . request('buscar') . '%')
                    ->orWhere('slug', 'like', '%' . request('buscar') . '%');
                });
            }

    if (request('categoria')) {
        $query->where('categoria_id', request('categoria'));
    }

    if (request()->filled('activo')) {
        $query->where('activo', request('activo'));
    }

    $productos = $query->latest()->paginate(10)->withQueryString();

    return view('admin.productos.index', [
        'productos' => $productos,
        'categorias' => Categoria::orderBy('nombre')->get(),
        'title' => 'Productos',
        'header' => 'Productos',
        'subheader' => 'Listado general de productos',
    ]);
}
   public function __construct()
    {
        $this->middleware('permission:productos.ver')->only('index');
        $this->middleware('permission:productos.crear')->only(['create', 'store']);
        $this->middleware('permission:productos.editar')->only(['edit', 'update']);
        $this->middleware('permission:productos.eliminar')->only('destroy');
    }

    public function create()
    {
        return view('admin.productos.create', [
            'categorias' => Categoria::where('activo', true)->orderBy('nombre')->get(),
            'title' => 'Nuevo producto',
            'header' => 'Nuevo producto',
            'subheader' => 'Creá un nuevo producto para la tienda',
        ]);
    }

    public function store(StoreProductoRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $data['activo'] = $request->boolean('activo');
        $data['destacado'] = $request->boolean('destacado');

        Producto::create($data);

        return redirect()
            ->route('admin.productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

   public function edit(Producto $producto)
    {
        return view('admin.productos.edit', [
            'producto' => $producto,
            'categorias' => Categoria::where('activo', true)->orderBy('nombre')->get(),
            'title' => 'Editar producto',
            'header' => 'Editar producto',
            'subheader' => 'Actualizá la información del producto',
        ]);
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $data['activo'] = $request->boolean('activo');
        $data['destacado'] = $request->boolean('destacado');

        $producto->update($data);

        return redirect()
            ->route('admin.productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()
            ->route('admin.productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    public function ofertaActiva()
    {
        return $this->hasOne(Oferta::class)
            ->where('activa', true)
            ->where(function ($query) {
                $query->whereNull('fecha_inicio')
                    ->orWhereDate('fecha_inicio', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('fecha_fin')
                    ->orWhereDate('fecha_fin', '>=', now());
            });
    }

    public function getPrecioFinalAttribute()
    {
        $oferta = $this->ofertaActiva;

        if (!$oferta) {
            return $this->precio;
        }

        if ($oferta->tipo === 'porcentaje') {
            return max($this->precio - ($this->precio * $oferta->valor / 100), 0);
        }

        if ($oferta->tipo === 'monto_fijo') {
            return max($this->precio - $oferta->valor, 0);
        }

        return $this->precio;
    }


    //PUBLICO
   public function productos()
    {
        $productos = Producto::with('categoria')->latest()->paginate(9);

        return view('tienda.productos.index', compact('productos'));
    }

    public function showProducto()
    {
        return view('tienda.productos.show');
    }
}