<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelpers;
use Closure;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTToken
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
        if (Route::currentRouteName() == 'api.single_page' || Route::currentRouteName() == 'api.single_page_v1') return $next($request);
        if ($request->header('app-id') != env('APP_ID') || $request->header('app-pass') != env('APP_PASS')) {
            return ResponseHelpers::serverErrorResponse();
        }
        if (Route::currentRouteName() == null){
            if (JWTAuth::user() == null) return  ResponseHelpers::authenticateErrorResponse();
        }
        return $next($request);
    }
}
