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

Route::get('/', function () {
    return 'ok';
});

