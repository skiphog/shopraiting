<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use App\Filters\ReviewFilter;

class IndexController extends Controller
{
    public function index()
    {
        $shops = Shop::select(['slug', 'pixel', 'img', 'name', 'rating', 'hack_rating', 'advantage', 'description'])
            ->positioned()
            ->withCount('reviews')
            ->get();

        $reviews = Review::latest('id')
            ->with('shop')
            ->take(2)
            ->get();

        return view('index', compact('shops', 'reviews'));
    }

    /**
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function recalls(ReviewFilter $filter)
    {
        $shops = Shop::getAllWithCache();
        $reviews = Review::latest('id')
            ->filter($filter)
            ->with('shop')
            ->take(2)
            ->get();
        $current_slug = '';

        return view('main.recall', compact('shops', 'reviews', 'current_slug'))->render();
    }

    /**
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function shopRecalls(Shop $shop, ReviewFilter $filter)
    {
        $shops = Shop::getAllWithCache();
        /** @noinspection PhpUndefinedMethodInspection */
        $reviews = $shop->reviews()
            ->filter($filter)
            ->latest('id')
            ->with('shop')
            ->take(2)
            ->get();

        $current_slug = $shop->slug;

        return view('main.recall', compact('shops', 'reviews', 'current_slug'))->render();
    }
}
