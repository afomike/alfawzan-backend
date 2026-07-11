<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceCorsHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $origin = $request->headers->get('Origin');
        $allowedOrigins = array_filter(config('cors.allowed_origins', []));

        if (! $origin || ! in_array($origin, $allowedOrigins, true)) {
            return $next($request);
        }

        if ($request->isMethod('OPTIONS')) {
            $response = response()->noContent();
        } else {
            $response = $next($request);
        }

        $requestedHeaders = $request->headers->get('Access-Control-Request-Headers');

        $response->headers->set('Access-Control-Allow-Origin', $origin);
        $response->headers->set('Vary', 'Origin', false);
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set(
            'Access-Control-Allow-Methods',
            implode(', ', config('cors.allowed_methods', ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS']))
        );
        $response->headers->set(
            'Access-Control-Allow-Headers',
            $requestedHeaders ?: '*'
        );

        return $response;
    }
}
