<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelpers;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTCheckTokenApi
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
        $user = JWTAuth::user();
        if (empty($user)) return ResponseHelpers::authenticateErrorResponse();
        return $next($request);
    }
}
