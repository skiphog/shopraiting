<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index()
    {
        $mod_reviews = Review::where('activity', 0)
            ->withoutGlobalScope('activity')
            ->with(['shop' => static fn($q) => $q->select(['id', 'name'])->withoutGlobalScope('activity')])
            ->latest('id')
            ->get();

        $reviews = Review::with(['shop' => static fn($q) => $q->select(['id', 'name'])->withoutGlobalScope('activity')])
            ->latest('id')
            ->paginate(20);

        return view('admin.reviews.index', compact('mod_reviews', 'reviews'));
    }

    public function edit(int $review_id)
    {
        $review = Review::withoutGlobalScope('activity')
            ->where('id', $review_id)
            ->with(['shop' => static fn($q) => $q->withoutGlobalScope('activity')->withCount('reviews')])
            ->firstOrFail();

        return view('admin.reviews.edit', compact('review'));
    }

    public function update(int $review_id, Request $request): JsonResponse
    {
        $this->validate($request, [
            'activity' => ['required', 'integer', Rule::in(Review::STATUS)]
        ]);

        $review = Review::withoutGlobalScope('activity')
            ->where('id', $review_id)
            ->firstOrFail();

        $review->update(['activity' => $request['activity']]);

        session()->flash('flash', ['message' => 'Статус отзыва обновлён']);

        return response()->json(['redirect' => route('admin.reviews.edit', $review)]);
    }

    public function destroy(int $review_id): JsonResponse
    {
        Review::withoutGlobalScope('activity')
            ->where('id', $review_id)
            ->firstOrFail()
            ->delete();

        session()->flash('flash', ['message' => 'Отзыв удалён']);

        return response()->json(['redirect' => route('admin.reviews.index')]);
    }

    public function search()
    {
    }
}
