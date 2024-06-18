<?php

use App\Http\Middleware\UserJPC;
use App\Http\Middleware\UserCOMPANY;
use App\Http\Middleware\UserAPPLICANT;
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
        //
        $middleware->alias([
            'role-jpc' => UserJPC::class,
            'role-company' => UserCOMPANY::class,
            'role-applicant' => UserAPPLICANT::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
