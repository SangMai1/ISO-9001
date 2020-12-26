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
            $table->timestamps();
            $table->string('ma');
            $table->string('ten');
            $table->date('ngaysinh');
            $table->smallInteger('gioitinh')->comment("0: nam, 1:nữ, 2:khác");
            $table->double('hesoluong');
            $table->bigInteger('chucdanhid');
            $table->bigInteger('phongbanid');
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
        Schema::dropIfExists('nhanviens');
    }
}
