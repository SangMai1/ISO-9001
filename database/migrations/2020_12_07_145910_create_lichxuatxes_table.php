<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichxuatxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichxuatxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('ngaytao');
            $table->dateTime('ngaysua');
            $table->bigInteger('xeid');
            $table->bigInteger('nhanvienid');
            $table->bigInteger('cuochopid');
            $table->dateTime('thoigiandidukien');
            $table->dateTime('thoigianvedukien');
            $table->dateTime('thoigiandithucte');
            $table->dateTime('thoigianvethucte');
            $table->bigInteger('sokmtruockhidi');
            $table->bigInteger('sokmsaukhidi');
            $table->string('diadiemdi');
            $table->string('ghichu');
            $table->string('nguoitao');
            $table->string('ngoisua');
            $table->smallInteger('daxoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lichxuatxes');
    }
}
