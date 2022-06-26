<?php

namespace App\View\Composers;

use App\Models\Shop;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class SliderComposer
{
    /**
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $shops = Cache::rememberForever('slider', static function () {
            return Shop::select(['slug', 'name', 'img', 'pixel', 'rating', 'hack_rating',])
                ->positioned()
                ->take(Shop::MAX_SLIDER_SHOW)
                ->get();
        });

        $view->with(compact('shops'));
    }
}