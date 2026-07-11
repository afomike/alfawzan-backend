<?php

return [
    'paths'                    => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods'          => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
    'allowed_origins'          => array_filter([
        env('FRONTEND_URL', 'http://localhost:3000'),
        env('FRONTEND_URL_PROD'),          // set this in .env when going live
    ]),
    'allowed_origins_patterns' => [],
    // Let the browser preflight whatever headers it needs for local SPA requests.
    'allowed_headers'          => ['*'],
    'exposed_headers'          => ['Set-Cookie'],
    'max_age'                  => 7200,
    'supports_credentials'     => true,   // required for httpOnly cookies
];
