<?php

namespace App\View\Composers;

use App\Models\Shop;
use Illuminate\View\View;

class SliderComposer
{
    /**
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with(['shops' => Shop::getTopWithCache()]);
    }
}