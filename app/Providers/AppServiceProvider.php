<?php

namespace App\Providers;

use Illuminate\Support\Facades\Mail;
use App\Services\OsPanelMailTransport;
use Illuminate\Support\ServiceProvider;

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
        Mail::extend('ospanel', static function () {
            return new OsPanelMailTransport();
        });
    }
}
