<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('id')->paginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
        ]);

        Role::create([
            'name' => strtoupper(trim($data['name'])),
            'guard_name' => 'web',
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rol creado correctamente.');
    }

    public function show(Role $role)
    {
        $role->load('permissions');

        return view('admin.roles.show', [
            'rol' => $role,
        ]);
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'rol' => $role,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($role->id),
            ],
        ]);

        $role->update([
            'name' => strtoupper(trim($data['name'])),
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'SUPER ADMIN') {
            return redirect()
                ->route('admin.roles.index')
                ->with('error', 'No se puede eliminar el rol SUPER ADMIN.');
        }

        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rol eliminado correctamente.');
    }

    public function permisos(Role $role)
    {
        $role->load('permissions');

        $permisos = Permission::orderBy('name')->get();

        $permisosAgrupados = $permisos->groupBy(function ($permiso) {
            $nombre = strtolower($permiso->name);

            if (str_contains($nombre, 'dashboard') || str_contains($nombre, 'perfil') || str_contains($nombre, 'password')) {
                return 'Vista admin';
            }

            if (str_contains($nombre, 'configuracion') || str_contains($nombre, 'ajuste')) {
                return 'Ajustes del sistema';
            }

            if (str_contains($nombre, 'rol')) {
                return 'Roles';
            }

            if (str_contains($nombre, 'usuario')) {
                return 'Usuarios';
            }

            if (str_contains($nombre, 'categoria')) {
                return 'Categorías';
            }

            if (str_contains($nombre, 'producto') || str_contains($nombre, 'imagen')) {
                return 'Productos';
            }

            if (str_contains($nombre, 'inventario') || str_contains($nombre, 'stock')) {
                return 'Inventario';
            }

            if (str_contains($nombre, 'oferta')) {
                return 'Ofertas';
            }

            if (str_contains($nombre, 'pedido')) {
                return 'Pedidos';
            }

            if (str_contains($nombre, 'venta') || str_contains($nombre, 'caja') || str_contains($nombre, 'reporte')) {
                return 'Ventas y caja';
            }

            return 'Otros';
        });

        return view('admin.roles.permisos', [
            'rol' => $role,
            'permisosAgrupados' => $permisosAgrupados,
        ]);
    }

    public function actualizarPermisos(Request $request, Role $role)
    {
        $data = $request->validate([
            'permisos' => ['nullable', 'array'],
            'permisos.*' => ['string', 'exists:permissions,name'],
        ]);

        $role->syncPermissions($data['permisos'] ?? []);

        return redirect()
            ->route('admin.roles.permisos', $role)
            ->with('success', 'Permisos actualizados correctamente.');
    }
   public function __construct()
    {
        $this->middleware('permission:roles.ver')->only(['index', 'show']);
        $this->middleware('permission:roles.editar-permisos')->only(['permisos', 'actualizarPermisos']);
    }
}