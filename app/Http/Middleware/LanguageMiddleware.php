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
    public function handle($request, Closure $next){
        if(session()->has('locale')) $lang = session('locale');
        else{
            // check browser lang
            $lang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            if (! in_array($lang, config('app.locales'))) $lang = config('app.locale');
        }

        app()->setLocale($lang);
        Carbon::setLocale($lang);

        return $next($request);
    }
}
