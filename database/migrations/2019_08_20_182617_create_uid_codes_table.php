<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUidCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uid_codes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('自增主键');
            $table->integer('uid')->unique()->comment('用户id');
            $table->char('code', 32)->unique()->comment('一次性code');
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
        Schema::dropIfExists('uid_codes');
    }
}
