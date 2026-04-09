<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            'dashboard.ver',

            'categorias.ver',
            'categorias.crear',
            'categorias.editar',
            'categorias.eliminar',

            'productos.ver',
            'productos.crear',
            'productos.editar',
            'productos.eliminar',

            'inventario.ver',
            'inventario.crear',
            'inventario.editar',

            'ofertas.ver',
            'ofertas.crear',
            'ofertas.editar',
            'ofertas.eliminar',

            'roles.ver',
            'roles.editar-permisos',

            'usuarios.ver',
            'usuarios.crear',
            'usuarios.editar',
            'usuarios.eliminar',

            'ventas.ver',
            'caja.ver',
            'reportes.ver',

            'perfil.ver',
            'perfil.editar',
            'pedidos_front.ver',
            'carrito.gestionar',
            'checkout.realizar',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'guard_name' => 'web',
            ]);
        }
    }
}