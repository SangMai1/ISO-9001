<?php

namespace Database\Seeders;

use App\Util\CommonUtil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommonUtil::seederJson('nhoms');
    }
}
