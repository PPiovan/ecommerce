<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function home()
    {
        $categorias = Categoria::orderBy('nombre')
            ->take(4)
            ->get();

        $productosDestacados = Producto::with(['categoria', 'ofertaActiva'])
            ->latest()
            ->take(8)
            ->get();

        $productosRecientes = Producto::with(['categoria', 'ofertaActiva'])
            ->latest()
            ->take(4)
            ->get();

        $productosEnOferta = Producto::with(['categoria', 'ofertaActiva'])
            ->whereHas('ofertaActiva')
            ->latest()
            ->take(4)
            ->get();

        return view('tienda.home', compact(
            'categorias',
            'productosDestacados',
            'productosRecientes',
            'productosEnOferta'
        ));
    }

    public function productos(Request $request)
    {
        $query = Producto::with(['categoria', 'ofertaActiva']);

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('categoria')) {
            $query->whereIn('categoria_id', $request->categoria);
        }

        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        if ($request->filled('stock') && $request->stock === 'con_stock') {
            $query->where('stock', '>', 0);
        }

        if ($request->filled('solo_ofertas') && $request->solo_ofertas == '1') {
            $query->whereHas('ofertaActiva');
        }

        switch ($request->orden) {
            case 'precio_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'nombre_asc':
                $query->orderBy('nombre', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $productos = $query->paginate(9)->withQueryString();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('tienda.productos.index', compact('productos', 'categorias'));
    }

    public function showProducto(Producto $producto)
    {
        $producto->load(['categoria', 'ofertaActiva']);

        $relacionados = Producto::with(['categoria', 'ofertaActiva'])
            ->where('id', '!=', $producto->id)
            ->when($producto->categoria_id, function ($query) use ($producto) {
                $query->where('categoria_id', $producto->categoria_id);
            })
            ->latest()
            ->take(4)
            ->get();

        return view('tienda.productos.show', compact('producto', 'relacionados'));
    }

    public function showCategoria(Categoria $categoria, Request $request)
    {
        $query = Producto::with(['categoria', 'ofertaActiva'])
            ->where('categoria_id', $categoria->id);

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        if ($request->filled('stock') && $request->stock === 'con_stock') {
            $query->where('stock', '>', 0);
        }

        switch ($request->orden) {
            case 'precio_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'nombre_asc':
                $query->orderBy('nombre', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $productos = $query->paginate(9)->withQueryString();

        return view('tienda.categorias.show', compact('categoria', 'productos'));
    }

    public function ofertas()
    {
        $productos = Producto::with(['categoria', 'ofertaActiva'])
            ->whereHas('ofertaActiva')
            ->latest()
            ->paginate(8);

        return view('tienda.ofertas.index', compact('productos'));
    }
}