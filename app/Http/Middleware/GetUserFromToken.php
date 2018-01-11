<?php

namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class GetUserFromToken
{
    public function handle($request, Closure $next)
    {
        config(['jwt.user' => '\App\Api\V1\Models\User']);
        config(['auth.providers.users.model' => \App\Api\V1\Models\User::class]);

        return $next($request);
    }
}