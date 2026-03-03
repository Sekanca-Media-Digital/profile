<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Redirect HTTP ke HTTPS di production.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->secure() && (app()->environment('production') || str_starts_with(config('app.url'), 'https://'))) {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
