<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cliente\TiendaController;
use App\Http\Controllers\Cliente\CarritoController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\InventarioController;
use App\Http\Controllers\Admin\OfertaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MisComprasController;
use App\Http\Controllers\Cliente\VentaController as ClienteVentaController;
use App\Http\Controllers\Admin\VentaController as AdminVentaController;
use App\Http\Controllers\Cliente\CheckoutController;
use App\Http\Controllers\Cliente\MercadoPagoController;



/*
|--------------------------------------------------------------------------
| FRONT / TIENDA
|--------------------------------------------------------------------------
*/

Route::get('/', [TiendaController::class, 'home'])->name('home');

Route::get('/productos', [TiendaController::class, 'productos'])->name('productos.index');
Route::get('/productos/{producto}', [TiendaController::class, 'showProducto'])->name('productos.show');

Route::get('/categorias', [TiendaController::class, 'categorias'])->name('categorias.index');
Route::get('/categorias/{categoria}', [TiendaController::class, 'showCategoria'])->name('categorias.show');

Route::get('/ofertas', [TiendaController::class, 'ofertas'])->name('ofertas.index');

/*
|--------------------------------------------------------------------------
| CARRITO
|--------------------------------------------------------------------------
*/

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{producto}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{producto}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');


/* MERACADO PAGO */
Route::post('/webhooks/mercadopago', [MercadoPagoController::class, 'webhook'])
    ->name('mercadopago.webhook');

/*
|--------------------------------------------------------------------------
| MI CUENTA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/mi-cuenta', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/mi-cuenta', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/mi-cuenta', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mi-cuenta/compras', [ClienteVentaController::class, 'index'])->name('cliente.ventas.index');
    Route::get('/mi-cuenta/compras/{venta}', [ClienteVentaController::class, 'show'])->name('cliente.ventas.show');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('cliente.checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('cliente.checkout.store');
    Route::get('/checkout/confirmacion/{venta}', [CheckoutController::class, 'confirmacion'])
    ->name('cliente.checkout.confirmacion');

    Route::post('/checkout/mercadopago', [MercadoPagoController::class, 'createPreference'])
    ->name('cliente.mercadopago.create');

    Route::get('/checkout/mercadopago/success', [MercadoPagoController::class, 'success'])
        ->name('cliente.mercadopago.success');

    Route::get('/checkout/mercadopago/pending', [MercadoPagoController::class, 'pending'])
        ->name('cliente.mercadopago.pending');

    Route::get('/checkout/mercadopago/failure', [MercadoPagoController::class, 'failure'])
        ->name('cliente.mercadopago.failure');
});



/*
|--------------------------------------------------------------------------
| LOGIN ADMIN SEPARADO
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

/*
|--------------------------------------------------------------------------
| PANEL ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin.access'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard')
            ->middleware('permission:dashboard.ver');

        Route::resource('categorias', CategoriaController::class)->except(['show']);
        Route::resource('productos', ProductoController::class)->except(['show']);
        Route::resource('ofertas', OfertaController::class)->except(['show']);
        Route::resource('roles', RoleController::class);
        Route::resource('usuarios', UserController::class);

        Route::get('inventario', [InventarioController::class, 'index'])
            ->name('inventario.index')
            ->middleware('permission:inventario.ver');

        Route::post('inventario', [InventarioController::class, 'store'])
            ->name('inventario.store')
            ->middleware('permission:inventario.crear');

        Route::get('roles/{role}/permisos', [RoleController::class, 'permisos'])
            ->name('roles.permisos')
            ->middleware('permission:roles.editar-permisos');

        Route::put('roles/{role}/permisos', [RoleController::class, 'actualizarPermisos'])
            ->name('roles.actualizar-permisos')
            ->middleware('permission:roles.editar-permisos');

        Route::get('/ventas', [AdminVentaController::class, 'index'])->name('ventas.index');
        Route::get('/ventas/{venta}', [AdminVentaController::class, 'show'])->name('ventas.show');
        Route::patch('/ventas/{venta}/estado', [AdminVentaController::class, 'updateEstado'])
            ->middleware('permission:ventas.editar')
            ->name('ventas.updateEstado');
    });

require __DIR__.'/auth.php';