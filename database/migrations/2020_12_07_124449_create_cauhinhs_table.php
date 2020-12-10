<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCauhinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cauhinhs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('ngaytao');
            $table->timestamp('ngaysua')->nullable()->default(null);
            $table->string('ma');
            $table->string('ten');
            $table->string('giatri');
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
        Schema::dropIfExists('cauhinhs');
    }
}
