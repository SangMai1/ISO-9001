<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucnangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chucnangs')->truncate();
        $content = file_get_contents('./database/seeders/seed-json/chucnangs.json', true);
        DB::table('chucnangs')->insert(json_decode($content, true));
    }
}
