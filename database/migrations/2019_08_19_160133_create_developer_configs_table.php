<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_configs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('自增主键');
            $table->string('appid', 32)->default('')->unique()->comment('appid');
            $table->char('app_secret', 32)->default('')->unique()->comment('密钥');
            $table->string('desc', 64)->default('')->comment('备注');
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
        Schema::dropIfExists('developer_configs');
    }
}
