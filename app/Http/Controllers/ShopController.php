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

    public function show(Shop $shop)
    {
        return view('shops.show', compact('shop'));
    }
}
