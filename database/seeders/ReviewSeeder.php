<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Review::truncate();
        Review::flushEventListeners();

        try {
            $shops = json_decode(
                file_get_contents(
                    base_path('database/data/reviews.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $shops = [];
        }

        DB::table('reviews')->insert($shops);
    }
}
