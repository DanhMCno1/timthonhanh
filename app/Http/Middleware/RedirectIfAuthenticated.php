<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string $guard): Response
    {
        if (Auth::guard($guard)->check()) {
            return match ($guard) {
                'admin' => redirect()->route('admin.orders.index'),
                'staff' => redirect()->route('staff.home'),
                default => redirect()->route('user.home'),
            };
        }

        return $next($request);
    }
}
