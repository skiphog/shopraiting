<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Question::truncate();
        Question::flushEventListeners();

        try {
            $questions = json_decode(
                file_get_contents(
                    base_path('database/data/questions.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $questions = [];
        }

        DB::table('questions')->insert($questions);
    }
}
