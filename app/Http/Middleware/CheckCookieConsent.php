<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckCookieConsent
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('cookie-consent') || $request->is('api/*')) {
            return $next($request);
        }

        $cookieConsent = $request->session()->get('cookie_consent');
        
        if (!$cookieConsent) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Cookie consent required'], 403);
            }
            
            return Inertia::render('CookieConsent');
        }

        return $next($request);
    }
} 