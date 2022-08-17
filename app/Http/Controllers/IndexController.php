<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use App\Models\Category;
use App\Filters\ReviewFilter;

class IndexController extends Controller
{
    public function index()
    {
        $category = Category::where('id', 1)->first();

        /*$shops = $category
            ->shops()
            ->positioned()
            ->get();*/

        $shops = Shop::withCount('reviews')
            ->positioned()
            ->get();

        $reviews = Review::latest('id')
            ->whereMorphedTo('post', Shop::class)
            ->with('post')
            ->take(2)
            ->get();

        return view('index', compact('shops', 'reviews', 'category'));
    }

    /**
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function recalls(ReviewFilter $filter)
    {
        $shops = Shop::getAllWithCache();

        $reviews = Review::latest('id')
            ->whereMorphedTo('post', Shop::class)
            ->filter($filter)
            ->with('post')
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
        $reviews = $shop->reviews()
            ->filter($filter)
            ->latest('id')
            ->with('post')
            ->take(2)
            ->get();

        $current_slug = $shop->slug;

        return view('main.recall', compact('shops', 'reviews', 'current_slug'))->render();
    }
}
