<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaisansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taisans')->truncate();
        $content = file_get_contents('./database/seeders/seed-json/taisans.json', true);
        DB::table('taisans')->insert(json_decode($content, true));
    }
}
