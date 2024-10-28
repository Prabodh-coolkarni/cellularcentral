<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()|| Auth::user()->Role=='admin'){
            return $next($request);
        }

        abort(403,'you are not allowed to');
    }

}


