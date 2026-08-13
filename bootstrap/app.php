<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
          'admins' => App\Http\Middleware\Admins::class,
          'user.active' => App\Http\Middleware\UserActive::class,
        ]);
    })

     ->withProviders([
        
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
    //