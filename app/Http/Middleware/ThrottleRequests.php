<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class ThrottleRequests
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next, $maxAttempts = 6, $decayMinutes = 1)
    {
        $key = $request->ip() . '|' . $request->path();

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            throw new TooManyRequestsHttpException(60, 'تعداد درخواست‌ها بیش از حد مجاز است. لطفاً بعداً تلاش کنید.');
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        return $next($request);
    }
}
