<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->input('token') !== 'my-secret-token') {
            return redirect('/');
        }
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }
    }
}
if ($request->input('token') !== 'my-secret-token') {
    return redirect('/');
}