<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $type = auth()->user()->role;
        // dd(bcrypt(1234));
        $actions = $request->route()->getAction();
        if ($type == $actions['type']) {
            return $next($request);
        }
        return redirect('login');
    }
}
