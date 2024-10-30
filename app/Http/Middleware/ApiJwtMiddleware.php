<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\ResponseFormatter;
use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiJwtMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return ResponseFormatter::error(null, 'Token is Invalid', 401);
            } elseif ($e instanceof TokenExpiredException) {
                return ResponseFormatter::error(null, 'Token is Expired', 401);
            } else {
                return ResponseFormatter::error(null, 'Authorization Token not found', 401);
            }
        }

        return $next($request);
    }
}
