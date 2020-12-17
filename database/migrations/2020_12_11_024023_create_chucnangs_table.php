<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChucnangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chucnangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten');
            $table->string('url');
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
        Schema::dropIfExists('chucnangs');
    }
}
