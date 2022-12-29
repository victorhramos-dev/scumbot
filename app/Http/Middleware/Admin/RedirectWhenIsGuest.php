<?php

namespace App\Http\Middleware\Admin;

use Closure;

use Illuminate\Support\Facades\Auth;

class RedirectWhenIsGuest
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
	    if (Auth::guard('administrator')->check() == false) {
	        return redirect(route('admin.login'));
	    }

	    return $next($request);
	}
}
