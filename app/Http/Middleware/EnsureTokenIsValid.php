<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class EnsureTokenIsValid
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
        
        if ($request->input('token') !== 'my-secret-token') {
            return redirect('/');
        }
        return $next($request);
    }
}
