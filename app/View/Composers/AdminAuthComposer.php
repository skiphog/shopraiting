<?php

namespace App\View\Composers;

use App\Models\Review;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\View\View;

class AdminAuthComposer
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
                ->with(['product' => static fn($q) => $q->select(['id', 'name'])->withoutGlobalScope('activity')])
                ->oldest('id')
                ->get(),

            'comments' => Comment::withoutGlobalScope('activity')
                ->with(['post' => static fn($q) => $q->withoutGlobalScope('activity')->select(['id', 'name'])])
                ->where('activity', 0)
                ->latest('id')
                ->get(),

            'questions' => Question::withoutGlobalScope('activity')
                ->where('activity', 0)
                ->latest('id')
                ->get()
        ]);
    }
}