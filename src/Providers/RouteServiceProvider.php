<?php

declare(strict_types=1);

namespace AdminKit\Articles\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as LaravelRouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends LaravelRouteServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(__DIR__.'/../UI/API/Routes/api.php');
        });
    }
}
