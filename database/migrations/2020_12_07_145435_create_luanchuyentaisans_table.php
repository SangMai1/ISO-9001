<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuanchuyentaisansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('luanchuyentaisans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('ngaytao');
            $table->timestamp('ngaysua')->nullable()->default(null);
            $table->bigInteger('taisanid');
            $table->bigInteger('nguoichuyen');
            $table->bigInteger('nguoinhan');
            $table->timestamp('thoigian')->nullable()->default(null);
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
        Schema::dropIfExists('luanchuyentaisans');
    }
}
