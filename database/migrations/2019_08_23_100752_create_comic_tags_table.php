<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComicTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comic_tags', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('自增主键');
            $table->integer('comic_id')->unsigned()->comment('漫画的id');
            $table->integer('tag_id')->unsigned()->comment('分类的id');
            $table->unique(['comic_id', 'tag_id']);
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
        Schema::dropIfExists('comic_tags');
    }
}
