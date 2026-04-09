<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminAuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.admin-login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

        if ($user->hasRole('CLIENTE')) {
            auth()->logout();

            return back()->withErrors([
                'email' => 'Este acceso es solo para personal administrativo.',
            ])->onlyInput('email');
        }

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }
}