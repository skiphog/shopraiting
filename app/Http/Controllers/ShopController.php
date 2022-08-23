<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Filters\ReviewFilter;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::select(['id', 'name', 'slug'])
            ->positioned()
            ->get();

        return view('shops.index', compact('shops'));
    }

    public function show(Shop $shop)
    {
        $shop
            ->load(['coupons' => static fn($q) => $q->activity()->sorting()])
            ->loadCount('reviews')
            ->load(['reviews' => static fn($q) => $q->take(2)->latest('id')->with('product:id,slug,name')]);

        $banners = Cache::rememberForever('banners', static fn() => Banner::all());

        return view('shops.show', compact('shop', 'banners'));
    }

    public function reviews(Shop $shop, Request $request, ReviewFilter $filter)
    {
        $reviews = $shop
            ->reviews()
            ->with('product:id,slug,name')
            ->latest('id')
            ->filter($filter)
            ->paginate(20)
            ->withQueryString();

        if ($request->ajax()) {
            return view('shops.recall', compact('reviews'))->render();
        }

        $shop->loadCount('reviews');

        return view('shops.reviews', compact('shop', 'reviews'));
    }
}
