<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = json_decode(file_get_contents('./share.json'), true);
        foreach ($tables as $t) {
            try {
                DB::table($t)->truncate();
                $content = file_get_contents('./database/seeders/seed-json/'.$t.'.json', true);
                DB::table($t)->insert(json_decode($content, true));
            } catch (\Throwable $th) {
                error_log("Cannot inserts table {" . $t . "}: {$th->getMessage()}");
            }
        }
        
    }
}
