<?php

namespace App\View\Composers;

use Illuminate\View\View;

class CabinetAuthComposer
{
    /**
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with(['user' => auth()->user()]);
    }
}