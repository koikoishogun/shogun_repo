<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->text('comment');
            //$table->integer("file_id")->unsigned()->nullable();
            $table->text("name");
            $table->string("email")->nullable();
            $table->foreign("post_id")->references("id")->on("posts")->onDelete("cascade");
            //$table->foreign("file_id")->references("id")->on("file_uploads");
            $table->timestamps();

        });

        //DB::statement("ALTER TABLE comments ADD file bytea");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
