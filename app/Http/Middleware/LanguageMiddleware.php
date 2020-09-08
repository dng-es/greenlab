<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class LanguageMiddleware
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
        if (session()->has('locale')) {
            $lang = session('locale');
        } else {
            // check browser lang
            $lang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            // check config lang
            if (! in_array($lang, config('app.locales'))) {
                $lang = config('app.locale');
            }
            
            // check site lang
            if (session()->has('site')) {
                $lang = session('site')->lang;
            }
        }

        app()->setLocale($lang);
        Carbon::setLocale($lang);

        return $next($request);
    }
}
