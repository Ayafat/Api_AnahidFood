<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->role === 'admin'){
            return $next($request);
        }
        
        
        
        return redirect()->back()->withErrors(['error' => 'شما اجازه دسترسی به این بخش را ندارید.']);
    }
}
