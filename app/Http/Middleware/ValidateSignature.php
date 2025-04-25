<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ValidateSignature
{
    public function handle(Request $request, Closure $next)
    {
        if (!URL::hasValidSignature($request)) {
            throw new AccessDeniedHttpException('لینک نامعتبر است یا منقضی شده.');
        }

        return $next($request);
    }
}
