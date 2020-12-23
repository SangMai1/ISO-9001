<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $content = file_get_contents('./database/seeders/seed-json/users.json', true);
        DB::table('users')->insert(json_decode($content, true));
    }
}
