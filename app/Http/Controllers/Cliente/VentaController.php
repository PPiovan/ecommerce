<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VentaController extends Controller
{
    /**
     * Listado de compras del usuario autenticado.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $ventas = Venta::query()
            ->withCount('detalles')
            ->where('user_id', $user->id)
            ->latest('id')
            ->paginate(10);

        return view('cliente.ventas.index', compact('ventas'));
    }

    /**
     * Mostrar el detalle de una compra del usuario autenticado.
     */
    public function show(Request $request, Venta $venta): View
    {
        $user = $request->user();

        abort_if((int) $venta->user_id !== (int) $user->id, 403);

        $venta->load([
            'detalles.producto',
        ]);

        return view('cliente.ventas.show', compact('venta'));
    }
}