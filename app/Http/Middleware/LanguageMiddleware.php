<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        // Get the language from the session, or default to 'gu'
        $locale = Session::get('locale', 'gu'); // 'gu' is the fallback if no language is set in the session

        // Set the application's locale
        App::setLocale($locale);

        // Proceed with the request
        return $next($request);
    }


}
