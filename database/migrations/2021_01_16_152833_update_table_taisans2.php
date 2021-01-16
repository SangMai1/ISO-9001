<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableTaisans2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taisans', function(Blueprint $table){
            $table->dropColumn('sohuu');
            $table->integer('sohuu_id')->nullable();
            $table->smallInteger('sohuu_type')->index()->comment('1: phòng ban, 2: nhân viên')->nullable(true);
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
