<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index()
    {
        $coupons = Coupon::oldest('id')->get();

        //dump(Storage::put('coupons.json', $coupons->toJson(JSON_UNESCAPED_UNICODE)));
    }
}