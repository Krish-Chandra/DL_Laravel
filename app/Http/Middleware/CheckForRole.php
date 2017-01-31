<?php
namespace App\Http\Middleware;

use Closure;

class CheckForRole
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
        $roles = array_slice(func_get_args(), 2);
        if (auth()->check() && auth()->user()->hasRole($roles))
        {
            return $next($request);
        }
        abort(403);
    }
}