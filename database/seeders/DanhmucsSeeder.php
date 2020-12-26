<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhmucsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danhmucs')->truncate();
        $content = file_get_contents('./database/seeders/seed-json/danhmucs.json', true);
        DB::table('danhmucs')->insert(json_decode($content, true));
    }
}
