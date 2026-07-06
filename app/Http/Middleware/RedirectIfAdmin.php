<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role == 0) {
            // Jika user adalah admin, redirect ke backend dashboard
            return redirect()->route('backend.beranda');
        }
        return $next($request);
    }
}
