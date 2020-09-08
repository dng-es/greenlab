<?php

namespace App\Http\Middleware;

use App\Site;
use Carbon\Carbon;
use Closure;

class SiteMiddleware
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
        $site = Site::findOrfail(1);
        session()->put('site', $site);

        return $next($request);
    }
}
