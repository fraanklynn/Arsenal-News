<?php

namespace App\Providers;

// Import harus ditaruh di sini, di bawah namespace
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; 

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
        // Sekarang URL::forceScheme akan bekerja dengan benar
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}