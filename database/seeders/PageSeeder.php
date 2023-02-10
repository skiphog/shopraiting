<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Page::truncate();
        Page::flushEventListeners();

        try {
            $pages = json_decode(
                file_get_contents(
                    base_path('database/data/pages.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $pages = [];
        }

        try {
            $page_shop = json_decode(
                file_get_contents(
                    base_path('database/data/page_shop.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $page_shop = [];
        }

        DB::table('pages')->insert($pages);
        DB::table('page_shop')->insert($page_shop);
    }
}
