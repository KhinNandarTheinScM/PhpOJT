<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Auth;
use Auth;

class VisitorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('_token')) {
            return $next($request);
        } else {
            if (Auth::user()) {
                return $next($request);
            } else {
                return redirect('/login');
            }
        }
    }
}
