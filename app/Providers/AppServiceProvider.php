<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

  public function boot(): void
    {   
        if (app()->environment('production')) {
        URL::forceScheme('https');
        }
        Gate::before(function ($user, $ability) {
            return $user->hasRole('SUPER ADMIN') ? true : null;
        });
    }
}