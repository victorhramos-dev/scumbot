<?php

namespace App\Http\Middleware\Admin;

use Closure;

use Illuminate\Support\Facades\Auth;

class RedirectWhenIsLogged
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  Illuminate\Http\Request  $request
	 * @param  Closure                  $next
	 * @param  string|null              $guard
	 *
	 * @return  mixed
	 */
	public function handle($request, Closure $next)
	{
	    if (Auth::guard('administrator')->check()) {
	        return redirect(route('admin.dashboard'));
	    }

	    return $next($request);
	}
}
