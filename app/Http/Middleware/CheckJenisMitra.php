<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckJenisMitra
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$expectedJenis)
    {
        $mitra = Auth::guard('mitra')->user();

        if (!$mitra || !in_array($mitra->jenis, $expectedJenis)) {
            return redirect()->route('mitra.dashboard')->with('error', 'Unauthorized Access');
        }

        return $next($request);
    }
}
