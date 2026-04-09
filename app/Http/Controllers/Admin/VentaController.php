<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VentaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Venta::query()
            ->with(['user'])
            ->withCount('detalles');

        if ($request->filled('estado')) {
            $query->where('estado', $request->string('estado'));
        }

        if ($request->filled('buscar')) {
            $buscar = $request->string('buscar');

            $query->where(function ($q) use ($buscar) {
                $q->where('id', 'like', "%{$buscar}%")
                    ->orWhereHas('user', function ($subQuery) use ($buscar) {
                        $subQuery->where('name', 'like', "%{$buscar}%")
                            ->orWhere('email', 'like', "%{$buscar}%");
                    });
            });
        }

        $ventas = $query
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $estados = [
            Venta::ESTADO_PENDIENTE,
            Venta::ESTADO_PAGADA,
            Venta::ESTADO_PREPARANDO,
            Venta::ESTADO_ENVIADA,
            Venta::ESTADO_ENTREGADA,
            Venta::ESTADO_CANCELADA,
        ];

        return view('admin.ventas.index', compact('ventas', 'estados'));
    }

   public function show(Venta $venta): View
    {
        $venta->load([
            'user',
            'detalles.producto',
        ]);

        $estados = [
            Venta::ESTADO_PENDIENTE,
            Venta::ESTADO_PAGADA,
            Venta::ESTADO_PREPARANDO,
            Venta::ESTADO_ENVIADA,
            Venta::ESTADO_ENTREGADA,
            Venta::ESTADO_CANCELADA,
        ];

        return view('admin.ventas.show', compact('venta', 'estados'));
    }

    public function updateEstado(Request $request, Venta $venta): RedirectResponse
    {
        $request->validate([
            'estado' => ['required', 'string', 'in:pendiente,pagada,preparando,enviada,entregada,cancelada'],
        ], [
            'estado.required' => 'Tenés que seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        $venta->update([
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('admin.ventas.show', $venta)
            ->with('success', 'El estado de la venta se actualizó correctamente.');
    }
}