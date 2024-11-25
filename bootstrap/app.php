<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'IsAdmin' => \App\Http\Middleware\IsAdmin::class,
            'IsUser' => \App\Http\Middleware\IsUser::class,
            'IsReferee'=>\App\Http\Middleware\IsReferee::class,
            'CheckUserType'=>\App\Http\Middleware\CheckUserType::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
