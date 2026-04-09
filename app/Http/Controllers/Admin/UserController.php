<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:usuarios.ver')->only(['index', 'show']);
        $this->middleware('permission:usuarios.crear')->only(['create', 'store']);
        $this->middleware('permission:usuarios.editar')->only(['edit', 'update']);
        $this->middleware('permission:usuarios.eliminar')->only(['destroy']);
    }

    public function index()
    {
        $usuarios = User::with('roles')->paginate(10);

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'rol' => ['required', 'exists:roles,name'],
        ]);

        $usuario = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $usuario->assignRole($data['rol']);

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function show(User $usuario)
    {
        $usuario->load('roles');

        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        $roles = Role::orderBy('name')->get();
        $rolActual = $usuario->getRoleNames()->first();

        return view('admin.usuarios.edit', compact('usuario', 'roles', 'rolActual'));
    }

    public function update(Request $request, User $usuario)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($usuario->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'rol' => ['required', 'exists:roles,name'],
        ]);

        $usuario->name = $data['name'];
        $usuario->email = $data['email'];

        if (!empty($data['password'])) {
            $usuario->password = Hash::make($data['password']);
        }

        $usuario->save();

        $usuario->syncRoles([$data['rol']]);

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        if (auth()->id() === $usuario->id) {
            return redirect()
                ->route('admin.usuarios.index')
                ->with('error', 'No podés eliminar tu propio usuario.');
        }

        $usuario->delete();

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    
}