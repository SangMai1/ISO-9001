<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackupSeed extends Seeder
{
    static $pathBackup = './database/seeders/seed-json/backup/';

    protected function customBackupTable($db, $table)
    {
        switch ($table) {
            case 'chucnangs':
            case 'users':
            case 'nhoms':
                $db->where('deleted_at', '=', null);
                break;
            case 'menus':
            
        }
        return $db->get();
    }
    public function run()
    {
        $tables = json_decode(file_get_contents('./share.json'), true);
        foreach ($tables as $t) {
            try {
                $file = fopen("{$this::$pathBackup}{$t}.json", "w");
                fwrite($file, json_encode($this->customBackupTable(DB::table($t), $t)));
                error_log('backup table => ' . $t);
            } catch (\Throwable $th) {
                error_log("Cannot backup table {" . $t . "}: {$th->getMessage()}");
            }
        }
        return;
    }
}
