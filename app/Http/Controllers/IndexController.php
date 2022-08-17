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

        $shops = $category
            ->shops()
            ->positioned()
            ->get();

        $reviews = Review::latest('id')
            ->whereMorphedTo('product', Shop::class)
            ->with('product:id,slug,name')
            ->take(2)
            ->get();

        return view('index', compact('shops', 'reviews', 'category'));
    }

    /**
     * @param ReviewFilter $filter
     *
     * @return string
     */
    public function recalls(ReviewFilter $filter): string
    {
        $shops = Shop::select(['id', 'slug', 'name'])
            ->whereRelation('categories', 'id', 1)
            ->positioned()
            ->get();

        $reviews = Review::latest('id')
            ->whereMorphedTo('product', Shop::class)
            ->filter($filter)
            ->with('product:id,slug,name')
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
        $shops = Shop::select(['id', 'slug', 'name'])
            ->whereRelation('categories', 'id', 1)
            ->positioned()
            ->get();

        $reviews = $shop->reviews()
            ->filter($filter)
            ->latest('id')
            ->with('product:id,slug,name')
            ->take(2)
            ->get();

        $current_slug = $shop->slug;

        return view('main.recall', compact('shops', 'reviews', 'current_slug'))->render();
    }
}
