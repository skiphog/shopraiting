<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('shops.index');
    }

    public function show(Shop $shop)
    {
        return view('shops.show', compact('shop'));
    }
}
