<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('自增主键');
            $table->string('name', 32)->default('')->comment('变量名称');
            $table->string('title', 32)->default('')->comment('变量的唯一标识');
            $table->text('value')->comment('变量的值');
            $table->string('desc', 100)->default('')->comment('变量的描述');

            $table->unique('title');
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
        Schema::dropIfExists('configs');
    }
}
