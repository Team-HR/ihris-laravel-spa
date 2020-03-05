<?php

namespace App\Http\Middleware;

use Closure;

class CheckSysAdmin
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
        if (auth()->user()->u_type == 'sys_admin') {
            return $next($request);
        }
        return redirect('home')->with('error',"You don't have system admin access.");
    }
}
