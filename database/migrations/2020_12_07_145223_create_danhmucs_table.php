<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanhmucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danhmucs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('ngaytao');
            $table->timestamp('ngaysua')->nullable()->default(null);
            $table->string('ma');
            $table->string('ten');
            $table->smallInteger('loai')->comment('0:chức danh, 1: phòng ban, 2: Loại tài sản');
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
        Schema::dropIfExists('danhmucs');
    }
}
