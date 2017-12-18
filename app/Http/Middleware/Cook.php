<?php

namespace App\Http\Middleware;

use Closure;

class Cook
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
        if (\Auth::user()->role->name == 'cook') {
            return $next($request);
        }

        return redirect('/login');
    }
}
