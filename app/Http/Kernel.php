<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
class Kernel extends HttpKernel
{
   protected $routeMiddleware = [
      'admin' => \App\Http\Middleware\AdminMiddleware::class,
      'isAdmin' => \App\Http\Middleware\EnsureAdmin::class,
   ];
   protected $middlewareGroups = [
      'api' => [
         \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
         'throttle:api',
         \Illuminate\Routing\Middleware\SubstituteBindings::class,
      ],
   ];

}