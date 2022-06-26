<?php

namespace Database\Seeders;

use JsonException;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::truncate();
        User::flushEventListeners();

        try {
            $users = json_decode(
                file_get_contents(
                    base_path('database/data/users.json')
                ), true, 512, JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            $users = [];
        }

        DB::table('users')->insert($users);
    }
}
