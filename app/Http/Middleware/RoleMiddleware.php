<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  \Role  $roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $roles = explode(" ", $roles);
        if (! $request->user()->hasAnyRole($roles)) {
            return abort(403, "Unauthorized");
        }

        return $next($request);
    }
}
