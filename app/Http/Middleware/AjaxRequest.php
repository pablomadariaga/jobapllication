<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AjaxRequest
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
        if (!$request->ajax()) {
            return abort(403);
        }
        return $next($request);
    }
}
