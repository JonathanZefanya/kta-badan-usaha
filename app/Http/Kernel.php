<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...existing global middleware...
    ];

    protected $middlewareGroups = [
        'web' => [
            // ...existing web middleware...
        ],
        'api' => [
            // ...existing api middleware...
        ],
    ];

    protected $routeMiddleware = [
        // ...existing route middleware...
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}
