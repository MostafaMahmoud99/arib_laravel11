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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "manager.guest" => \App\Http\Middleware\ManagerRedirect::class,
            "manager.auth" => \App\Http\Middleware\ManagerAuthenticate::class
        ]);

        $middleware->redirectTo(
            guests: 'employee/auth/login',
            users: 'employee/dashboard'
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
