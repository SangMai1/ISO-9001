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
        DB::table('chucnangs')->insert([
            ['ten' => 'Danh sách xe', 'url' => '/xe/danh-sach', 'nguoitao' => 'sang', 'nguoisua' => 'sang', 'daxoa' => 0],
            ['ten' => 'Thêm xe', 'url' => '/xe/them-xe', 'nguoitao' => 'sang', 'nguoisua' => 'sang', 'daxoa' => 0],
            ['ten' => 'Xóa xe', 'url' => '/xe/xóa-xe', 'nguoitao' => 'sang', 'nguoisua' => 'sang', 'daxoa' => 0],
            ['ten' => 'Xóa xe', 'url' => '/xe/xóa-xe', 'nguoitao' => 'sang', 'nguoisua' => 'sang', 'daxoa' => 0],
            ['ten' => 'Xóa xe', 'url' => '/xe/xóa-xe', 'nguoitao' => 'sang', 'nguoisua' => 'sang', 'daxoa' => 0],
            ['ten' => 'Xóa xe', 'url' => '/xe/xóa-xe', 'nguoitao' => 'sang', 'nguoisua' => 'sang', 'daxoa' => 0],
            ['ten' => 'Xóa xe', 'url' => '/xe/xóa-xe', 'nguoitao' => 'sang', 'nguoisua' => 'sang', 'daxoa' => 0],
            ['ten' => 'Xóa xe', 'url' => '/xe/xóa-xe', 'nguoitao' => 'sang', 'nguoisua' => 'sang', 'daxoa' => 0],
            ['ten' => 'Xóa xe', 'url' => '/xe/xóa-xe', 'nguoitao' => 'sang', 'nguoisua' => 'sang', 'daxoa' => 0],
        ]);
    }
}
