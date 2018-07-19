<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     *
     *
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('post');
            //$table->text('tag');
            $table->text('title');
            //$table->text('file');//->unsigned()->nullable();
            $table->string("feature")->nullable();
            //$table->text("author");
            $table->string('like')->nullable();
            $table->string("link")->unique()->nullable();
            $table->timestamps();
            //$table->foreign("file_id")->references("id")->on("file_uploads");
        });
         //DB::statement("ALTER TABLE posts ADD file MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('posts');
    }
}
