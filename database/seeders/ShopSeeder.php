<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Shop::truncate();
        Shop::flushEventListeners();

        try {
            $shops = json_decode(
                file_get_contents(
                    base_path('database/data/shops.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $shops = [];
        }

        DB::table('shops')->insert($shops);
    }
}
