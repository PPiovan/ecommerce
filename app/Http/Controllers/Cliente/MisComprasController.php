<?php

namespace App\Http\Controllers\Cliente;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MisComprasController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $compras = Venta::query()
            ->when(
                \Schema::hasColumn('ventas', 'user_id'),
                fn ($query) => $query->where('user_id', $user->id),
                fn ($query) => $query->where('id_cliente', $user->id)
            )
            ->latest()
            ->paginate(10);

        return view('profile.compras.index', compact('compras', 'user'));
    }

    public function show(Request $request, Venta $venta): View
    {
        $user = $request->user();

        $esDelUsuario = false;

        if (isset($venta->user_id)) {
            $esDelUsuario = (int) $venta->user_id === (int) $user->id;
        } elseif (isset($venta->id_cliente)) {
            $esDelUsuario = (int) $venta->id_cliente === (int) $user->id;
        }

        abort_unless($esDelUsuario, 403);

        $venta->load([
            'detalles.producto',
        ]);

        return view('profile.compras.show', compact('venta', 'user'));
    }
}