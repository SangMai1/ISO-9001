<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idcha');
            $table->string('ten');
            $table->string('url');
            $table->integer('vitri');
            $table->bigInteger('chucnangid');
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
        Schema::dropIfExists('menuses');
    }
}
