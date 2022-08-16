<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Coupon;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index()
    {
        //$brands = Brand::oldest('id')->get();

        //dump(Storage::put('brands.json', $brands->toJson(JSON_UNESCAPED_UNICODE)));
    }
}