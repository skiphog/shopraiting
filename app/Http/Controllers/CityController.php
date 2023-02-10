<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\City;
use App\Models\Review;
use App\Models\Banner;
use App\Filters\ReviewFilter;
use Illuminate\Support\Facades\Cache;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();

        return view('cities.index', compact('cities'));
    }

    public function show(City $city)
    {
        $shops = $city->shops()
            ->withCount('reviews')
            ->positioned()
            ->get();

        $reviews = Review::whereIn('product_id', $shops->pluck('id'))
            ->whereMorphedTo('product', Shop::class)
            ->with('product:id,slug,name')
            ->take(2)
            ->get();

        $banners = Cache::rememberForever('banners', static fn() => Banner::all());

        return view('cities.show', compact('shops', 'reviews', 'city', 'banners'));
    }

    /**
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function recalls(City $city, ReviewFilter $filter)
    {
        $shops = $city->shops()
            ->select(['id', 'slug', 'name'])
            ->positioned()
            ->get();

        $reviews = Review::whereIn('product_id', $shops->pluck('id'))
            ->whereMorphedTo('product', Shop::class)
            ->filter($filter)
            ->with('product:id,slug,name')
            ->take(2)
            ->get();

        $current_slug = '';

        return view('cities.recall', compact('city', 'shops', 'reviews', 'current_slug'))->render();
    }

    /**
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function shopRecalls(City $city, Shop $shop, ReviewFilter $filter)
    {
        $shops = $city->shops()
            ->select(['id', 'slug', 'name'])
            ->positioned()
            ->get();

        $reviews = $shop->reviews()
            ->filter($filter)
            ->latest('id')
            ->with('product:id,slug,name')
            ->take(2)
            ->get();

        $current_slug = $shop->slug;

        return view('cities.recall', compact('city', 'shops', 'reviews', 'current_slug'))->render();
    }
}