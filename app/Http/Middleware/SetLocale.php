<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = ['en', 'ar', 'tr'];
        $locale = $request->route('locale');

        if (! is_string($locale) || ! in_array($locale, $availableLocales, true)) {
            $locale = Session::get('locale', config('app.locale', 'en'));
        }

        App::setLocale($locale);
        Session::put('locale', $locale);
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
