<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Article::truncate();
        Article::flushEventListeners();

        try {
            $articles = json_decode(
                file_get_contents(
                    base_path('database/data/articles.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $articles = [];
        }

        DB::table('articles')->insert($articles);
    }
}
