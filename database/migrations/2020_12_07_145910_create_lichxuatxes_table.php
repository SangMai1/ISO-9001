<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichxuatxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichxuatxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('xeid');
            $table->bigInteger('nhanvienid');
            $table->bigInteger('cuochopid');
            $table->timestamp('thoigiandidukien')->nullable()->default(null);
            $table->timestamp('thoigianvedukien')->nullable()->default(null);
            $table->timestamp('thoigiandithucte')->nullable()->default(null);
            $table->timestamp('thoigianvethucte')->nullable()->default(null);
            $table->bigInteger('sokmtruockhidi');
            $table->bigInteger('sokmsaukhidi');
            $table->string('diadiemdi');
            $table->string('ghichu');
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
        Schema::dropIfExists('lichxuatxes');
    }
}
