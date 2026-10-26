<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Login na thakle login page e pathao
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Role allowed list e na thakle 403
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Tomar ei page dekhar permission nei.');
        }

        return $next($request);
    }
}