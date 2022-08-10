<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Filters\ReviewFilter;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::getAllWithCache();

        return view('shops.index', compact('shops'));
    }

    public function reviews(Shop $shop, Request $request, ReviewFilter $filter)
    {
        $reviews = Review::where('shop_id', $shop->id)
            ->with('shop')
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

    public function show(Shop $shop)
    {
        $shop
            ->load(['coupons' => static fn($q) => $q->activity()->sorting()])
            ->loadCount('reviews')
            ->load(['reviews' => static fn($q) => $q->take(2)->latest('id')->with('shop')]);

        return view('shops.show', compact('shop'));
    }
}
