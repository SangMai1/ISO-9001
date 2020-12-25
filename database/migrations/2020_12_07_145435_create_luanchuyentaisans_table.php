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
            $table->timestamps();
            $table->bigInteger('taisanid');
            $table->bigInteger('nguoichuyen');
            $table->bigInteger('nguoinhan');
            $table->timestamp('thoigian')->nullable()->default(null);
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
        Schema::dropIfExists('luanchuyentaisans');
    }
}
