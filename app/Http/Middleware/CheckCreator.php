<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckCreator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->type === 'CREATOR' || Auth::user()->type === 'ADMIN')) {
            return $next($request);
        }
        
        return redirect()->route('dashboard')->with('error', 'You do not have access to this page.');
    }
}
