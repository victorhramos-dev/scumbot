<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForceHttps
{
    public function handle($request, Closure $next)
    {
        $currentIsWWW = Str::contains($request->fullUrl(), 'www.');

        $appIsWWW = Str::contains(env('APP_URL'), 'www.');

        if ($currentIsWWW == true && $appIsWWW == false) {
            $redirectUrl = str_replace('www.', '', $request->fullUrl());

            return redirect($redirectUrl);
        }

        if ($currentIsWWW == false && $appIsWWW == true) {
            $redirectUrl = str_replace('://', '://www.', $request->fullUrl());

            return redirect($redirectUrl);
        }

        if (!$request->secure() && env('APP_ENV') === 'production') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
