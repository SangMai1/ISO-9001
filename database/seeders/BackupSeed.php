<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackupSeed extends Seeder
{
    static $tables = [
        'users',
        'chucnangs',
<<<<<<< HEAD
        'danhmucs',
        'nhanviens',
        'cauhinhs'
=======
        'nhoms'
>>>>>>> 1a03cae458ea842f567fb3ba38d7a7e7fde1a226
    ];
    static $pathBackup = './database/seeders/seed-json/backup/';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this::$tables as $t) {
            try {
                $file = fopen("{$this::$pathBackup}{$t}.json", "w");
                fwrite($file, json_encode(DB::table($t)->get()));
            } catch (\Throwable $th) {
                error_log("Cannot backup table {" . $t . "}: {$th}");
            }
        }
    }
}
