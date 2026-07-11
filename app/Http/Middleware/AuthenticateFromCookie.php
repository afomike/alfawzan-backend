<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
     * If the request has an httpOnly auth_token cookie but no Authorization header,
     * inject the header so Sanctum's token guard picks it up transparently.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->hasCookie('auth_token') &&
            ! $request->hasHeader('Authorization')
        ) {
            $request->headers->set(
                'Authorization',
                'Bearer ' . $request->cookie('auth_token')
            );
        }

        return $next($request);
    }
}
