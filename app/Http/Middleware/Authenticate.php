<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::check() === false) {
            if ($request->ajax()) {
                return response('Please login to access this resource.', 401);
            } else {
                return redirect()->guest('/login')->withErrors('Please login to access this resource.');
            }
        }

        return $next($request);
    }
}
