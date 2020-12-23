<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuochopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuochops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('ma');
            $table->string('ten');
            $table->string('diadiem');
            $table->string('noidung');
            $table->smallInteger('trangthai');
            $table->string('nguoitao');
            $table->string('nguoisua');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuochops');
    }
}
