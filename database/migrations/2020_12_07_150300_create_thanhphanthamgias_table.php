<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThanhphanthamgiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thanhphanthamgias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('ngaytao');
            $table->dateTime('ngaysua');
            $table->bigInteger('cuochopid');
            $table->smallInteger('loai')->comment('0:trong công ty, 1:ngoài công ty');
            $table->bigInteger('nhanvienid');
            $table->bigInteger('nguoingoaiid');
            $table->string('nhiemvu');
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
        Schema::dropIfExists('thanhphanthamgias');
    }
}
