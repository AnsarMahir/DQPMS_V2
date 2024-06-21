<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'STUDENT' role
        if (Auth::check() && Auth::user()->type === 'STUDENT') {
            return $next($request);
        }

        // Redirect to the dashboard with a flash message
        return redirect()->route('dashboard')->with('error', 'You do not have access to this page.');
    }
}
