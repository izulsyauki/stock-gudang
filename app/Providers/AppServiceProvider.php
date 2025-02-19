<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\AuthRepository;
use App\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthRepository::class, function ($app) {
            return new AuthRepository();
        });

        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService($app->make(AuthRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
