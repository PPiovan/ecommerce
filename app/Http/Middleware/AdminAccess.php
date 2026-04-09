<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('admin.login');
        }

        if ($user->hasRole('CLIENTE')) {
            abort(403, 'No tenés acceso al panel administrativo.');
        }

        return $next($request);
    }
}