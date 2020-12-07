<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhanviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanviens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('ngaytao');
            $table->dateTime('ngaysua');
            $table->string('ma');
            $table->string('ten');
            $table->string('email');
            $table->date('ngaysinh');
            $table->smallInteger('gioitinh');
            $table->double('hesoluong');
            $table->bigInteger('chucdanhid');
            $table->bigInteger('phongbanid');
            $table->string('nguoitao');
            $table->string('ngoisua');
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
        Schema::dropIfExists('nhanviens');
    }
}
