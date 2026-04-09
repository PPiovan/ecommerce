<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoController extends Controller
{
    public function createPreference(Request $request): RedirectResponse
    {
        $request->validate([
            'observaciones' => ['nullable', 'string', 'max:1000'],
        ]);

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

        foreach ($resumen['items'] as $item) {
            if ($item['cantidad'] > $item['producto']->stock) {
                return redirect()
                    ->route('carrito.index')
                    ->with('error', 'No hay stock suficiente para el producto: ' . $item['producto']->nombre);
            }
        }

        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));

        $client = new PreferenceClient();

        $items = [];

        foreach ($resumen['items'] as $item) {
            $items[] = [
                'title' => $item['producto']->nombre,
                'quantity' => $item['cantidad'],
                'unit_price' => (float) $item['precio_unitario'],
                'currency_id' => 'ARS',
            ];
        }

        $preference = $client->create([
            'items' => $items,
            'back_urls' => [
                'success' => route('cliente.mercadopago.success'),
                'pending' => route('cliente.mercadopago.pending'),
                'failure' => route('cliente.mercadopago.failure'),
            ],
            'auto_return' => 'approved',
            'external_reference' => (string) auth()->id(),
            'notification_url' => route('mercadopago.webhook'),
        ]);

        return redirect()->away($preference->init_point);
    }

    public function success(Request $request)
    {
        return redirect()
            ->route('cliente.ventas.index')
            ->with('success', 'Volviste desde Mercado Pago. Estamos confirmando tu pago.');
    }

    public function pending(Request $request)
    {
        return redirect()
            ->route('cliente.ventas.index')
            ->with('warning', 'Tu pago quedó pendiente de confirmación.');
    }

    public function failure(Request $request)
    {
        return redirect()
            ->route('cliente.checkout.index')
            ->with('error', 'El pago no se pudo completar.');
    }

    private function obtenerProductosDelCarrito(array $carrito)
    {
        $ids = array_keys($carrito);

        return Producto::query()
            ->whereIn('id', $ids)
            ->get()
            ->keyBy('id');
    }

    private function armarResumenCompra($productos, array $carrito): array
    {
        $items = [];
        $subtotal = 0;

        foreach ($carrito as $productoId => $itemCarrito) {
            $producto = $productos->get((int) $productoId);

            if (! $producto) {
                continue;
            }

            $cantidad = max(1, (int) ($itemCarrito['cantidad'] ?? 1));
            $precioUnitario = max(0, (float) $producto->precio);
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
}