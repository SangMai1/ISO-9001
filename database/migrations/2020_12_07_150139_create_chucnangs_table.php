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
            $table->id();
            $table->string('ten');
            $table->string('url');
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
        Schema::dropIfExists('chucnangs');
    }
}
