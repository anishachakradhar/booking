<?php

namespace App\Providers;

use App\Payment;
use App\BookDate;
use Illuminate\Support\ServiceProvider;
use App\Observers\BookDateActionObserver;
use App\Observers\PaymentCompletedActionObserver;

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
        Payment::observe(PaymentCompletedActionObserver::class);
    }
}
