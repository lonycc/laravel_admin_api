<?php

namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ApiLogs
{
    public function handle($request, Closure $next)
    {
        $log = new \App\Models\OperationLog();
        $log->setAttribute('user', \Auth::user()->name);
        $log->setAttribute('path', $request->path());
        $log->setAttribute('method', $request->method());
        $log->setAttribute('ip', $request->ip());
        $log->setAttribute('input', json_encode($request->all(), JSON_UNESCAPED_UNICODE));
        $log->save();

        return $next($request);
    }
}