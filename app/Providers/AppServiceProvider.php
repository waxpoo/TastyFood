<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Berita;
use App\Models\FormKontak;
use App\Models\Galeri;

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
    public function boot(): void
    {
        // Menggunakan Bootstrap 5 untuk paginasi
        Paginator::useBootstrapFive();

        // Menyediakan variabel global untuk seluruh view
        View::composer('*', function ($view) {
            $view->with('totalBerita', Berita::count());
            $view->with('totalGaleri', Galeri::count());
            $view->with('totalKontak', FormKontak::count());
        });
    }
}
