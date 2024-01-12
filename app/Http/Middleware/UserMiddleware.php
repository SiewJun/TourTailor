<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'user') {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized action.'], 403);
    }
}

