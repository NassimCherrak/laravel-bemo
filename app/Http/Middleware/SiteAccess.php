<?php

namespace App\Http\Middleware;

use Closure;

class SiteAccess
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
        if($request->session()->has('siteaccess') and $request->session()->has('siteaccess') == true) {
            return $next($request);
        }
        
        return redirect('/access');
    }
}
