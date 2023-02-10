<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Cache::flush();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $this->call([
            UserSeeder::class,
            ShopSeeder::class,
            BrandSeeder::class,
            ReviewSeeder::class,
            ArticleSeeder::class,
            QuestionSeeder::class,
            PageSeeder::class,
            CouponSeeder::class,
            CitySeeder::class,
        ]);

        //Storage::deleteDirectory('upload');
        //Storage::makeDirectory('upload');
    }
}
