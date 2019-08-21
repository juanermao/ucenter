<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUidTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uid_tokens', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('自增主键');
            $table->integer('uid')->unique()->comment('用户id');
            $table->char('token', 32)->unique()->comment('access_token');
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
        Schema::dropIfExists('uid_tokens');
    }
}
