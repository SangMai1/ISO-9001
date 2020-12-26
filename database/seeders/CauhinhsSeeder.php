<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CauhinhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cauhinhs')->truncate();
        $content = file_get_contents('./database/seeders/seed-json/cauhinhs.json', true);
        DB::table('cauhinhs')->insert(json_decode($content, true));
    }
}
