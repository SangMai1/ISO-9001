<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaisansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taisans', function (Blueprint $table) {
            $table->id();
            $table->string('mataisan');
            $table->string('tentaisan');
            $table->float('giatien');
            $table->integer('khauhao');
            $table->foreignId('loaitaisanid');
            $table->string('nguoitao');
            $table->timestamp('ngaytao');
            $table->string('nguoisua');
            $table->timestamp('ngaysua')->nullable()->default(null);
            $table->integer('daxoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taisans');
    }
}
