<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::where('name', 'SUPER ADMIN')->first();
        $admin = Role::where('name', 'ADMIN')->first();
        $empleado = Role::where('name', 'EMPLEADO')->first();
        $contador = Role::where('name', 'CONTADOR')->first();
        $deposito = Role::where('name', 'DEPOSITO')->first();

        // SUPER ADMIN
        $superAdmin?->givePermissionTo(\Spatie\Permission\Models\Permission::all());

        // ADMIN
        $admin?->syncPermissions([
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

            'ventas.ver',
            'caja.ver',
            'reportes.ver',
        ]);

        // EMPLEADO
        $empleado?->syncPermissions([
            'dashboard.ver',

            'categorias.ver',

            'productos.ver',
            'productos.crear',
            'productos.editar',

            'inventario.ver',

            'ofertas.ver',
        ]);

        // CONTADOR
        $contador?->syncPermissions([
            'dashboard.ver',
            'ventas.ver',
            'caja.ver',
            'reportes.ver',
        ]);

        // DEPOSITO
        $deposito?->syncPermissions([
            'dashboard.ver',
            'inventario.ver',
            'inventario.crear',
            'inventario.editar',
            'productos.ver',
        ]);
        
        //CLIENTE
        $cliente = Role::where('name', 'CLIENTE')->first();

        $cliente?->syncPermissions([
            'perfil.ver',
            'perfil.editar',
            'pedidos_front.ver',
            'carrito.gestionar',
            'checkout.realizar',
        ]);
    }
}