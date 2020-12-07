<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichsusuachuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichsusuachuas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('ngaytao');
            $table->dateTime('ngaysua');
            $table->bigInteger('taisanid');
            $table->bigInteger('nguoidisua');
            $table->dateTime('thoigiansua');
            $table->bigInteger('giatien');
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
        Schema::dropIfExists('lichsusuachuas');
    }
}
