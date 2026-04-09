<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\InventarioController;
use App\Http\Controllers\Admin\OfertaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categorias', CategoriaController::class)->except(['show']);
        Route::resource('productos', ProductoController::class)->except(['show']);
        Route::resource('ofertas', OfertaController::class)->except(['show']);
        Route::resource('roles', RoleController::class);
        Route::resource('usuarios', UserController::class);

        Route::get('inventario', [InventarioController::class, 'index'])->name('inventario.index');
        Route::post('inventario', [InventarioController::class, 'store'])->name('inventario.store');

        Route::get('roles/{role}/permisos', [RoleController::class, 'permisos'])
            ->name('roles.permisos');

        Route::put('roles/{role}/permisos', [RoleController::class, 'actualizarPermisos'])
            ->name('roles.actualizar-permisos');
            
        
    });