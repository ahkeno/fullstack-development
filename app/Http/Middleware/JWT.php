<?php

namespace App\Http\Middleware;
use JWTAuth;
use Closure;

class JWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        JWTAuth::parseToken()->authenticate();
        // $headers = apache_request_headers(); //get header
        // $request->headers->set('Authorization', $headers['authorization']);// set header in request
        return $next($request);
    }
}
