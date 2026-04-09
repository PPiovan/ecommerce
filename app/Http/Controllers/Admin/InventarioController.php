<?php

namespace App\Http\Controllers\Admin;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\InventarioMovimiento;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Inventario\StoreInventarioMovimientoRequest;

class InventarioController extends Controller
{
    public function index()
    {
        $movimientos = InventarioMovimiento::with(['producto', 'usuario'])
            ->latest()
            ->paginate(15);

        return view('admin.inventario.index', [
            'movimientos' => $movimientos,
            'productos' => Producto::orderBy('nombre')->get(),
            'title' => 'Inventario',
            'header' => 'Inventario',
            'subheader' => 'Movimientos y control de stock',
        ]);
    }

    public function store(StoreInventarioMovimientoRequest $request)
        {
            $producto = Producto::findOrFail($request->producto_id);
            $cantidad = (int) $request->cantidad;
            $stockAnterior = (int) $producto->stock;
            $stockNuevo = $stockAnterior;

            if ($request->tipo === 'ingreso') {
                $stockNuevo = $stockAnterior + $cantidad;
                $producto->update([
                    'stock' => $stockNuevo,
                ]);
            }

            if ($request->tipo === 'egreso') {
                if ($stockAnterior < $cantidad) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'No hay stock suficiente para registrar el egreso.');
                }

                $stockNuevo = $stockAnterior - $cantidad;

                $producto->update([
                    'stock' => $stockNuevo,
                ]);
            }

            if ($request->tipo === 'ajuste') {
                $stockNuevo = $cantidad;

                $producto->update([
                    'stock' => $stockNuevo,
                ]);
            }

            InventarioMovimiento::create([
                'producto_id' => $producto->id,
                'tipo' => $request->tipo,
                'cantidad' => $cantidad,
                'stock_anterior' => $stockAnterior,
                'stock_nuevo' => $stockNuevo,
                'motivo' => $request->motivo,
                'detalle' => $request->detalle,
                'user_id' => auth()->id(),
            ]);

            return redirect()
                ->route('admin.inventario.index')
                ->with('success', 'Movimiento de inventario registrado correctamente.');
        }
    public function __construct()
    {
        $this->middleware('permission:inventario.ver')->only('index');
        $this->middleware('permission:inventario.crear')->only('store');
    }
}