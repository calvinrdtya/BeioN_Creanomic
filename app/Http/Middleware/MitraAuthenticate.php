<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class MitraAuthenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('mitra.login');
    }

    protected function authenticate($request, array $guards)
    {
        if ($this->auth->guard('mitra')->check()) {
            return $this->auth->shouldUse('mitra');
        }

        $this->unauthenticated($request, ['mitra']);
    }
}
