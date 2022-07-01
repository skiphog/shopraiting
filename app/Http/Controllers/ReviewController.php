<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Filters\ReviewFilter;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function index(Request $request, ReviewFilter $filter)
    {
        $data = [
            'reviews'      => Review::latest('id')
                ->filter($filter)
                ->with('shop')
                ->paginate(20)
                ->withQueryString(),
            'current_slug' => ''
        ];

        if ($request->ajax()) {
            return view('reviews.recall', $data)->render();
        }

        return view('reviews.index', $data);
    }

    public function shop(Shop $shop, Request $request, ReviewFilter $filter)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $data = [
            'reviews'      => $shop->reviews()
                ->latest('id')
                ->filter($filter)
                ->with('shop')
                ->paginate(20)
                ->withQueryString(),
            'current_slug' => $shop->slug
        ];

        if ($request->ajax()) {
            return view('reviews.recall', $data)->render();
        }

        return view('reviews.index', $data);
    }

    /**
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function store(ReviewRequest $request)
    {
        Review::create($request->safe()->toArray());

        return response()->json(['response' => 'Ваш отзыв отправлен на модерацию!']);
    }
}
