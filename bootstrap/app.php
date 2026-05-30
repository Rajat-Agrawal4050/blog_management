<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->alias([
            'jwt.auth1' => \App\Http\Middleware\JwtMiddleware::class,
            'admin.auth' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $middleware->web(prepend: [
            \App\Http\Middleware\GuestJwtMiddleware::class,
        ]);

          $middleware->api(append: [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,        //  Decrypt/Encrypt
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, //  Cookie response mein add karna
    ]);
        //        $middleware->api(prepend: [
        //     \App\Http\Middleware\JwtMiddleware::class,
        // ]);


    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
