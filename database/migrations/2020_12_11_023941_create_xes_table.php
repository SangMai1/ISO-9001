<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('taisanid');
            $table->string('bienso');
            $table->integer('socho');
            $table->bigInteger('nhanvienid');
            $table->string('nguoitao');
            $table->string('nguoisua');
            $table->timestamps();
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
        Schema::dropIfExists('xes');
    }
}
