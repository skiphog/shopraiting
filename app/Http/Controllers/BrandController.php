<?php

namespace App\Http\Controllers;

use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::positioned()->get();

        return view('brands.index', compact('brands'));
    }

    public function reviews(Brand $brand)
    {
        return view('brands.reviews', compact('brand'));
    }
}
