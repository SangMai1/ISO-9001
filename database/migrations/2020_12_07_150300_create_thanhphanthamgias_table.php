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
            $table->timestamp('ngaytao');
            $table->timestamp('ngaysua')->nullable()->default(null);
            $table->bigInteger('cuochopid');
            $table->smallInteger('loai')->comment('0:trong công ty, 1:ngoài công ty');
            $table->smallInteger('loaithamgia')->comment('0 :Người tham gia, 1: Chủ trì, 2: Người chuẩn bị');
            $table->bigInteger('nhanvienid');
            $table->string('tennguoingoai');
            $table->string('nhiemvu');
            $table->string('ghichu');
            $table->string('nguoitao');
            $table->string('nguoisua');
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
