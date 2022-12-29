<?php

namespace App\Http\Middleware;

use Closure;
use View;

use Illuminate\Support\Facades\Auth;

class ViewShareLoggedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Closure                  $next
     * @param  string                   $guard
     *
     * @return  mixed
     */
    public function handle($request, Closure $next, $guard = 'administrator')
    {
        View::share('isLoggedIn', Auth::guard($guard)->check());
        View::share('loggedUser', Auth::guard($guard)->user());

        return $next($request);
    }
}