<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

  public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('SUPER ADMIN') ? true : null;
        });
    }
}