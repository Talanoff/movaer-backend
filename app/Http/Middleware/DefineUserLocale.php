<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DefineUserLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header('X-Locale', 'en');

        if (! in_array($locale, config('app.locales'), true)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
