<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function edit(int $shop_id)
    {
        $shop = Shop::withoutGlobalScope('activity')
            ->select(['id', 'name'])
            ->with(['coupons' => static fn($q) => $q->sorting()])
            ->where('id', $shop_id)
            ->firstOrFail();

        return view('admin.shops.coupons', compact('shop'));
    }

    public function update()
    {
    }
}