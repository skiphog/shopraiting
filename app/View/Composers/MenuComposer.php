<?php

namespace App\View\Composers;

use App\Models\Shop;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class MenuComposer
{
    /**
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $shops = Cache::rememberForever('menu', static function () {
            return Shop::select(['slug', 'name'])
                ->positioned()
                ->take(Shop::MAX_SHOW)
                ->get();
        });

        $view->with(compact('shops'));
    }
}