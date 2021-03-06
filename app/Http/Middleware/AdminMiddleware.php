<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()){
            return redirect()->route('login');
        } elseif (!auth()->user()->isAdmin()) {
            return redirect()->back()->withStatus('У Вас немає прав на цю операцію!');
        } else {
            return $next($request);
        }
        
    }
}
