<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use App\Models\Banner;
use App\Models\Page;
use App\Filters\ReviewFilter;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index()
    {
        $page = Page::where('id', 1)->first();

        $shops = $page
            ->shops()
            ->positioned()
            ->get();

        $reviews = Review::latest('id')
            ->whereMorphedTo('product', Shop::class)
            ->with('product:id,slug,name')
            ->take(2)
            ->get();

        $banners = Cache::rememberForever('banners', static fn() => Banner::all());

        return view('index', compact('shops', 'reviews', 'page', 'banners'));
    }

    /**
     * @param ReviewFilter $filter
     *
     * @return string
     */
    public function recalls(ReviewFilter $filter): string
    {
        $shops = Shop::select(['id', 'slug', 'name'])
            ->whereRelation('pages', 'id', 1)
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
            ->whereRelation('pages', 'id', 1)
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
