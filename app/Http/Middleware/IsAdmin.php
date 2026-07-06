<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role == 0) {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
