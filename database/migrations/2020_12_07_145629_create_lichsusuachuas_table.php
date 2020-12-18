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
            $table->timestamps();
            $table->bigInteger('taisanid');
            $table->bigInteger('nguoidisua');
            $table->timestamp('thoigiansua')->nullable()->default(null);
            $table->bigInteger('giatien');
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
        Schema::dropIfExists('lichsusuachuas');
    }
}
