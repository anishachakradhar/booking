<?php

namespace App\Providers;

use App\BookDate;
use Illuminate\Support\ServiceProvider;
use App\Observers\BookDateActionObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BookDate::observe(BookDateActionObserver::class);
    }
}
