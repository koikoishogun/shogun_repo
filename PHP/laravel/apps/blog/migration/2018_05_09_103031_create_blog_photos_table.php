<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filezzs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('type');
            $table->string('size');
            $table->longText('path')->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE filezzs ADD file MEDIUMBLOB");


        Schema::create('blog_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('header')->nullable();
            $table->integer('post_id')->unsigned()->nullable();
            $table->string('footer')->nullable();
            $table->integer('file_id')->unsigned();
            $table->foreign("post_id")->references('id')->on('posts')->onDelete("set null");
            $table->foreign("file_id")->references('id')->on('filezzs');
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
         Schema::dropIfExists('filezzs');
        Schema::dropIfExists('blog_photos');
    }
}
