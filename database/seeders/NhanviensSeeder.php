<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanviensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nhanviens')->truncate();
        $content = file_get_contents('./database/seeders/seed-json/nhanviens.json', true);
        DB::table('nhanviens')->insert(json_decode($content, true));
    }
}
