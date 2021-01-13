<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class XesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('xes')->truncate();
        $content = file_get_contents('./database/seeders/seed-json/xes.json', true);
        DB::table('xes')->insert(json_decode($content, true));
    }
}
