<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


public function boot()
{
    // Menggunakan Bootstrap 5 untuk paginasi
    Paginator::useBootstrapFive();
}

}
