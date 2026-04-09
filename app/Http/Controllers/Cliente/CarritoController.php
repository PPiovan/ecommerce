<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarritoController extends Controller
{
    public function index(): View
    {
        $carrito = session()->get('carrito', []);

        $subtotal = collect($carrito)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });

        return view('tienda.carrito.index', compact('carrito', 'subtotal'));
    }

    public function agregar(Request $request, Producto $producto): RedirectResponse
    {
        $cantidad = max(1, (int) $request->input('cantidad', 1));

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$producto->id])) {
            $nuevaCantidad = $carrito[$producto->id]['cantidad'] + $cantidad;

            if ($producto->cantidad !== null && $nuevaCantidad > $producto->cantidad) {
                $nuevaCantidad = $producto->cantidad;
            }

            $carrito[$producto->id]['cantidad'] = $nuevaCantidad;
        } else {
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => (float) $producto->precio,
                'cantidad' => $producto->cantidad !== null ? min($cantidad, $producto->cantidad) : $cantidad,
                'imagen' => $producto->imagen_url ?? null,
                'stock' => (int) ($producto->cantidad ?? 0),
                'slug' => $producto->id,
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function actualizar(Request $request, Producto $producto): RedirectResponse
    {
        $cantidad = max(1, (int) $request->input('cantidad', 1));

        $carrito = session()->get('carrito', []);

        if (!isset($carrito[$producto->id])) {
            return back()->with('error', 'El producto no está en el carrito.');
        }

        if ($producto->cantidad !== null && $cantidad > $producto->cantidad) {
            $cantidad = $producto->cantidad;
        }

        $carrito[$producto->id]['cantidad'] = $cantidad;

        session()->put('carrito', $carrito);

        return back()->with('success', 'Cantidad actualizada.');
    }

    public function eliminar(Producto $producto): RedirectResponse
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$producto->id])) {
            unset($carrito[$producto->id]);
            session()->put('carrito', $carrito);
        }

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function vaciar(): RedirectResponse
    {
        session()->forget('carrito');

        return back()->with('success', 'Carrito vaciado.');
    }
}