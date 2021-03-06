<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguoingoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoingoais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('ten');
            $table->string('email');
            $table->smallInteger('gioitinh');
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
        Schema::dropIfExists('nguoingoais');
    }
}
