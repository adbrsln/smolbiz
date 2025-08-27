<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasBusiness
{
    public function handle(Request $request, Closure $next): Response
    {
        // The new route is in the 'management' panel
        $businessCreateRoute = 'filament.home.resources.businesses.create';
        if (auth()->user() && !auth()->user()->businesses()->exists() && !$request->routeIs($businessCreateRoute)) {
            return redirect()->route($businessCreateRoute);
        }

        return $next($request);
    }
}
