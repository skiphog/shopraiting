<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Filters\ReviewFilter;

class ReviewController extends Controller
{
    public function index(ReviewFilter $filter)
    {
        $reviews = Review::latest('id')
            ->filter($filter)
            ->with('shop')
            ->paginate(20);
        $current_slug = '';

        return view('reviews.index', compact('reviews', 'current_slug'));
    }
}
