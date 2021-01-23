<?php

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCuocHop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('thanhphanthamgias');
        Schema::table('cuochops', function (Blueprint $table) {
            $table->dropColumn('ma');
            $table->timestamp('thoigianbatdau');
            $table->timestamp('thoigianketthuc');
        });

        Schema::table('danhmucs', function (Blueprint $table) {
            $table->index('loai');
        });

        Schema::create('thamgiacuochops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('donvithamgia_id');
            $table->integer('donvithamgia_type')
                ->comment('1: nhân viên trong công ty')
                ->comment('2: người ngoài công ty tham gia')
                ->comment('3: phòng ban');
            $table->integer('vaitroid')
                ->comment('liên kết với table danhmucs với danhmucs.type = 44');
            $table->text('ghichu');
        });
        
        Schema::table('phongbans', function (Blueprint $table) {
            $table->integer('truongphong_nvid');
            $table->string('ma');
            $table->integer('nguoitao');
            $table->integer('nguoisua');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
