<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class CacheControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

        public function handle(Request $request, Closure $next): Response
    {
       
         $response = $next($request);

        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        //$response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    
    
}

}
