<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\View\Composers\MenuComposer;
use App\View\Composers\SliderComposer;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\AdminAuthComposer;
use App\View\Composers\CabinetAuthComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('layouts.partials.menu', MenuComposer::class);
        View::composer('partials.slider', SliderComposer::class);
        View::composer('admin.blocks.auth', AdminAuthComposer::class);
        View::composer('layouts.cabinet', CabinetAuthComposer::class);
    }
}
