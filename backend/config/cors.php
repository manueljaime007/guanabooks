<?php

return [
    'paths' => [
        'api/*',
        'sanctum/csrf-cookie'
    ],
    'allowed_methods' => ['*'],
    'allowed_origin' => [
        env('FRONTEND_ADMIN_URL'),
        env('FRONTEND_CLIENT_URL'),
        'http://localhost:4077',
        'http://localhost:3000',
    ],
    'allowed_origins_patterns' => [],
    'exposed_headers' => [],
    'max_age' => 0,
    'support_credentials' => true
];
