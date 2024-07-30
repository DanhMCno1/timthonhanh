<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfUnauthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard): Response
    {
        if (!Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'admin': return redirect()->route('admin.signin');
                case 'staff': return redirect()->route('staff.signin.create');
                case 'web':
                    if ($request->expectsJson()) {
                        return response()->json([
                            'error' => 'Unauthorized',
                            'redirect' => route('signin')
                        ], 401);
                    }
                    return redirect()->route('signin');
            }

        }

        return $next($request);
    }
}
