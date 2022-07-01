<?php

namespace App\Http\Controllers;

use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::getAllWithCache();

        return view('shops.index', compact('shops'));
    }

    public function reviews(Shop $shop)
    {
        $shop->loadCount('reviews');
        return view('shops.reviews', compact('shop'));
    }

    public function show(Shop $shop)
    {
        $shop
            ->loadCount('reviews')
            ->load(['reviews' => static fn($q) => $q->take(2)->latest('id')->with('shop')]);

        return view('shops.show', compact('shop'));
    }
}
