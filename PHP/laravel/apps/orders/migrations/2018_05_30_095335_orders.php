<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->unsigned()->nullable();
            $table->integer("product_id")->unsigned()->nullable();
            $table->foreign("product_id")->references("id")->on("shops")->onDelete('set null');
            $table->text("quantity")->nullable();
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
        //
        Schema::dropIfExists('orders');
    }
}
