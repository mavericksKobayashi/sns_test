<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('place',999)->nullable();
            $table->string('map',999)->nullable();
            $table->string('contents',1200)->nullable();
            $table->string('category',99)->nullable();
            $table->integer('date')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('pickup')->nullable();
            $table->integer('like')->nullable();
            $table->integer('publish')->nullable();
            $table->integer('freeze')->nullable();
            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
