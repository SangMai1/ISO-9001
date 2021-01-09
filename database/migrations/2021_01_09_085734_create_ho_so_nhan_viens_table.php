<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoSoNhanViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosonhanviens', function (Blueprint $table) {
            $table->id();
            $table->int('nhanvienid');
            $table->double('hesoluong');
            $table->string('diachi')->nullable(true);
            $table->string('cmnd')->nullable(true);
            $table->string('trinhdochuyenmon')->nullable(true);
            $table->string('thoigianlamviec')->nullable(true);
            $table->string('baohiemyte')->nullable(true);
            $table->string('baohiemxahoi')->nullable(true);
            $table->string('baohiemthatnghiep')->nullable(true);
            $table->string('baohiemthatnghiep')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosonhanviens');
    }
}
