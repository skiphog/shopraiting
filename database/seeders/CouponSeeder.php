<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::truncate();
        Coupon::flushEventListeners();

        try {
            $coupons = json_decode(
                file_get_contents(
                    base_path('database/data/coupons.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $coupons = [];
        }

        DB::table('coupons')->insert($coupons);
    }
}
