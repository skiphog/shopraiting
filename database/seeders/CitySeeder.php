<?php

namespace Database\Seeders;

use JsonException;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        City::truncate();
        City::flushEventListeners();

        try {
            $cities = json_decode(
                file_get_contents(
                    base_path('database/data/cities.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $cities = [];
        }

        DB::table('cities')->insert($cities);
    }
}