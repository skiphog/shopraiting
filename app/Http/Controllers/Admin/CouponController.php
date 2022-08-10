<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;

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

    public function update(int $shop_id, CouponRequest $request): JsonResponse
    {
        $shop = Shop::withoutGlobalScope('activity')
            ->where('id', $shop_id)
            ->firstOrFail();

        $data = $request->safe();

        DB::transaction(static function () use ($shop, $data) {
            $shop->coupons()->delete();

            foreach ($data['coupons'] ?? [] as $item) {
                $shop->coupons()->create($item);
            }

            $shop->update();
        });

        return response()->json(['response' => 'OK']);
    }
}