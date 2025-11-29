<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

use function App\Helpers\hasPermission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        App::bind('hasPermission', function () {
            return function ($moduleId, $action) {
                return hasPermission($moduleId, $action);
            };
        });
    }
}
