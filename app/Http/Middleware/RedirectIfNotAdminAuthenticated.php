<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check())
        {
            return redirect(route('admin.login'));
        }
        else
        {
            if(!Auth::user()->is_admin && !Auth::user()->is_super_admin)
                return redirect(locale_route('home'));
        }

        return $next($request);
    }
}
