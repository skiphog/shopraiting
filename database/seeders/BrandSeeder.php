<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Brand::truncate();
        Brand::flushEventListeners();

        try {
            $brands = json_decode(
                file_get_contents(
                    base_path('database/data/brands.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $brands = [];
        }

        DB::table('brands')->insert($brands);
    }
}
