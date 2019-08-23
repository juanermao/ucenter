<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComicListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comic_lists', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('自增主键');
            $table->integer('comic_id')->unsigned()->comment('章节的id');
            $table->string('index', 32)->comment('章节的目录');
            $table->string('title', 64)->comment('章节的标题');
            $table->tinyInteger('is_pay')->default(2)->comment('是否需要付费，默认为2表示免费，为1表示需要付费');
            $table->bigInteger('point')->default(0)->comment('若需要付费，付费金额（积分）');
            $table->text('content')->comment('章节的具体内容');
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
        Schema::dropIfExists('comic_lists');
    }
}
