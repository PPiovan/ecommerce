<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
class CheckoutController extends Controller
{
    /**
     * Mostrar resumen del checkout.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()
                ->route('carrito.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        $productos = $this->obtenerProductosDelCarrito($carrito);

        if ($productos->isEmpty()) {
            return redirect()
                ->route('carrito.index')
                ->with('error', 'No se encontraron productos válidos en el carrito.');
        }

        $resumen = $this->armarResumenCompra($productos, $carrito);

        return view('cliente.checkout.index', [
            'items' => $resumen['items'],
            'subtotal' => $resumen['subtotal'],
            'total' => $resumen['total'],
        ]);
    }

    /**
     * Procesar compra y guardar venta.
     */
    public function store(Request $request): RedirectResponse
    {   
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()
                ->route('carrito.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        $request->validate([
            'metodo_pago' => ['required', 'string', 'in:efectivo,transferencia,mercadopago'],
            'observaciones' => ['nullable', 'string', 'max:1000'],
        ], [
            'metodo_pago.required' => 'Tenés que seleccionar un método de pago.',
            'metodo_pago.in' => 'El método de pago seleccionado no es válido.',
        ]);
        
        $productos = $this->obtenerProductosDelCarrito($carrito);

        if ($productos->isEmpty()) {
            return redirect()
                ->route('carrito.index')
                ->with('error', 'No se encontraron productos válidos en el carrito.');
        }

        $resumen = $this->armarResumenCompra($productos, $carrito);

        try {
            DB::beginTransaction();

            foreach ($resumen['items'] as $item) {
                if ($item['cantidad'] > $item['producto']->stock) {
                    DB::rollBack();

                    return redirect()
                        ->route('carrito.index')
                        ->with('error', 'No hay stock suficiente para el producto: ' . $item['producto']->nombre);
                }
            }

            $venta = Venta::create([
                'user_id' => $request->user()->id,
                'fecha' => now(),
                'estado' => 'pendiente',
                'subtotal' => $resumen['subtotal'],
                'total' => $resumen['total'],
                'metodo_pago' => $request->input('metodo_pago'),
                'observaciones' => $request->input('observaciones'),
            ]);

            foreach ($resumen['items'] as $item) {
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item['producto']->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();
            
            if ($request->metodo_pago === 'mercadopago') {
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));

            $itemsMp = [];

            foreach ($resumen['items'] as $item) {
                $itemsMp[] = [
                    'title' => $item['producto']->nombre,
                    'quantity' => (int) $item['cantidad'],
                    'unit_price' => (float) $item['precio_unitario'],
                    'currency_id' => 'ARS',
                ];
            }

            

            $client = new PreferenceClient();

            try {
                $preference = $client->create([
                    'items' => $itemsMp,
                    'external_reference' => (string) $venta->id,
                    
                    'auto_return' => 'approved',
                ]);

                dd($preference);
            } catch (\Throwable $mpError) {
                dd(
                    $mpError->getMessage(),
                    method_exists($mpError, 'getCode') ? $mpError->getCode() : null,
                    $itemsMp,
                    [
                        'success' => route('cliente.checkout.confirmacion', $venta),
                        'failure' => route('cliente.checkout.index'),
                        'pending' => route('cliente.checkout.index'),
                    ]
                );
            }
            return redirect()->away($preference->init_point);
        }

            foreach ($resumen['items'] as $item) {
                $item['producto']->decrement('stock', $item['cantidad']);
            }

            session()->forget('carrito');

            return redirect()
                ->route('cliente.checkout.confirmacion', $venta)
                ->with('success', 'Tu compra se registró correctamente.');

        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    /**
     * Obtener productos existentes del carrito.
     */
    private function obtenerProductosDelCarrito(array $carrito)
    {
        $ids = array_keys($carrito);

        return Producto::query()
            ->whereIn('id', $ids)
            ->get()
            ->keyBy('id');
    }

    /**
     * Armar resumen final con datos reales desde BD.
     */
    private function armarResumenCompra($productos, array $carrito): array
    {
        $items = [];
        $subtotal = 0;

        foreach ($carrito as $productoId => $itemCarrito) {
            $producto = $productos->get((int) $productoId);

            if (! $producto) {
                continue;
            }

            $cantidad = (int) ($itemCarrito['cantidad'] ?? 1);
            $precioUnitario = (float) $producto->precio;
            $itemSubtotal = $cantidad * $precioUnitario;

            $items[] = [
                'producto' => $producto,
                'cantidad' => $cantidad,
                'precio_unitario' => $precioUnitario,
                'subtotal' => $itemSubtotal,
            ];

            $subtotal += $itemSubtotal;
        }

        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'total' => $subtotal,
        ];
    }

    public function confirmacion(Request $request, Venta $venta): View
    {
        abort_if((int) $venta->user_id !== (int) $request->user()->id, 403);

        $venta->load('detalles.producto');

        return view('cliente.checkout.confirmacion', compact('venta'));
    }
}