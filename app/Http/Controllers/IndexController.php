<?php

namespace App\Http\Controllers;

use App\Models\Shop;

class IndexController extends Controller
{
    public function index()
    {
        $shops = Shop::select(['slug', 'pixel', 'img', 'name', 'rating', 'hack_rating', 'advantage', 'description'])
            ->positioned()
            ->withCount('reviews')
            ->get();

        return view('index', compact('shops'));
    }
}
