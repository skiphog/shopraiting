<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Filters\ReviewFilter;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::positioned()->get();

        return view('brands.index', compact('brands'));
    }

    public function reviews(Brand $brand, Request $request, ReviewFilter $filter)
    {
        $reviews = $brand
            ->reviews()
            ->with('product:id,slug,name')
            ->latest('id')
            ->filter($filter)
            ->paginate(20)
            ->withQueryString();

        if ($request->ajax()) {
            return view('shops.recall', compact('reviews'))->render();
        }

        return view('brands.reviews', compact('brand', 'reviews'));
    }
}
