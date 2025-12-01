<?php

namespace App\Providers;

use App\Models\UserPermission;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;



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
        app()->bind('hasPermission', function () {
            return function ($moduleId, $action) {

                $user = auth()->user();
                if (!$user) return false;

                // Admin = all access
                if ($user->role == 'admin') {
                    return true;
                }

                // Staff permissions check
                return \App\Models\UserPermission::where('user_id', $user->id)
                    ->where('module_id', $moduleId)
                    ->where($action, 1)
                    ->exists();
            };
        });
    }
}
