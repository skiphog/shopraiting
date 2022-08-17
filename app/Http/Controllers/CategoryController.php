<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use App\Models\Category;
use App\Filters\ReviewFilter;

class CategoryController extends Controller
{
    public function index()
    {
    }

    public function show(Category $category)
    {
        $shops = $category->shops()
            ->withCount('reviews')
            ->positioned()
            ->get();

        $reviews = Review::whereIn('post_id', $shops->pluck('id'))
            ->whereMorphedTo('post', Shop::class)
            ->with('post')
            ->take(2)
            ->get();

        return view('index', compact('shops', 'reviews', 'category'));
    }

    /**
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function recalls(Category $category, ReviewFilter $filter)
    {
        $shops = $category->shops()
            ->select(['id', 'slug', 'name'])
            ->positioned()
            ->get();

        $reviews = Review::whereIn('post_id', $shops->pluck('id'))
            ->whereMorphedTo('post', Shop::class)
            ->filter($filter)
            ->with('shop')
            ->take(2)
            ->get();

        $current_slug = '';

        return view('categories.recall', compact('category', 'shops', 'reviews', 'current_slug'))->render();
    }

    /**
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function shopRecalls(Category $category, Shop $shop, ReviewFilter $filter)
    {
        $shops = $category->shops()
            ->select(['id', 'slug', 'name'])
            ->positioned()
            ->get();

        $reviews = $shop->reviews()
            ->filter($filter)
            ->latest('id')
            ->with('shop')
            ->take(2)
            ->get();

        $current_slug = $shop->slug;

        return view('categories.recall', compact('category', 'shops', 'reviews', 'current_slug'))->render();
    }
}