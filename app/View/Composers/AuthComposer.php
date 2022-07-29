<?php

namespace App\View\Composers;

use App\Models\Review;
use Illuminate\View\View;

class AuthComposer
{
    /**
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with([
            'user'    => auth()->user(),
            'reviews' => Review::where('activity', 0)
                ->withoutGlobalScope('activity')
                ->with(['shop' => static fn($q) => $q->select(['id', 'name'])->withoutGlobalScope('activity')])
                ->oldest('id')
                ->get()
        ]);
    }
}