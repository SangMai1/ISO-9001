<?php

namespace Database\Seeders;

use App\Util\CommonUtil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommonUtil::seederJson('menus');
    }
}
